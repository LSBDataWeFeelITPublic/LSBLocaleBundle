<?php
declare(strict_types=1);

namespace LSB\LocaleBundle\Manager;

use LSB\ContractorBundle\Entity\ContractorInterface;
use LSB\LocaleBundle\Entity\CountryInterface;
use LSB\LocaleBundle\Entity\TaxInterface;
use LSB\LocaleBundle\Factory\TaxFactoryInterface;
use LSB\LocaleBundle\Repository\TaxRepositoryInterface;
use LSB\UtilityBundle\Factory\FactoryInterface;
use LSB\UtilityBundle\Form\BaseEntityType;
use LSB\UtilityBundle\Helper\ValueHelper;
use LSB\UtilityBundle\Manager\ObjectManagerInterface;
use LSB\UtilityBundle\Manager\BaseManager;
use LSB\UtilityBundle\Repository\RepositoryInterface;
use Ibericode\Vat\Validator;
use LSB\UtilityBundle\Value\Value;
use Money\Currency;
use Money\Money;

/**
 * Class TaxManager
 * @package LSB\LocaleBundle\Manager
 */
class TaxManager extends BaseManager
{
    const TIMEOUT = '10';

    const DEFAULT_TAX = 23;
    const DEFAULT_COUNTRY_CODE = 'PL';

    protected Validator $vatValidator;

    protected int $defaultTax;

    protected string $appCountryCode;

    protected bool $checkAppCountryCode;

    protected ?CountryInterface $sellerCountry;

    protected CountryManager $countryManager;

    /**
     * TaxManager constructor.
     * @param CountryManager $countryManager
     * @param ObjectManagerInterface $objectManager
     * @param TaxFactoryInterface $factory
     * @param TaxRepositoryInterface $repository
     * @param BaseEntityType|null $form
     * @param Validator $vatValidator
     * @param int $defaultTax
     * @param string $appCountryCode
     * @param bool $checkAppCountryCode
     */
    public function __construct(
        ObjectManagerInterface $objectManager,
        TaxFactoryInterface $factory,
        TaxRepositoryInterface $repository,
        ?BaseEntityType $form,
        CountryManager $countryManager,
        Validator $vatValidator,
        int $defaultTax = self::DEFAULT_TAX,
        string $appCountryCode = self::DEFAULT_COUNTRY_CODE,
        bool $checkAppCountryCode = false
    ) {
        parent::__construct($objectManager, $factory, $repository, $form);

        $this->countryManager = $countryManager;
        $this->vatValidator = $vatValidator;
        $this->defaultTax = $defaultTax;
        $this->appCountryCode = $appCountryCode;
        $this->checkAppCountryCode = $checkAppCountryCode;
    }

    /**
     * @return TaxInterface|object
     */
    public function createNew(): TaxInterface
    {
        return parent::createNew();
    }

    /**
     * @return TaxFactoryInterface|FactoryInterface
     */
    public function getFactory(): TaxFactoryInterface
    {
        return parent::getFactory();
    }

    /**
     * @return TaxRepositoryInterface|RepositoryInterface
     */
    public function getRepository(): TaxRepositoryInterface
    {
        return parent::getRepository();
    }


    /**
     * Calculation of the tax value based on the given amount
     *
     * @param float $nettoValue
     * @param TaxInterface|null $tax
     * @param bool $addVat
     * @param CountryInterface|null $customerCountry
     * @param int|null $customerType
     * @param string|null $customerTaxNumber
     * @return array
     * @throws \Exception
     */
    public function calculateTaxValue(
        float $nettoValue,
        TaxInterface $tax = null,
        bool $addVat = true,
        CountryInterface $customerCountry = null,
        ?int $customerType = null,
        ?string $customerTaxNumber = null
    ): array {

        $grossValue = 0;
        if ($addVat === null && $customerCountry === null && $customerType == null && $customerTaxNumber) {
            throw new \Exception('Missing data for vat calculation');
        } elseif ($addVat === null) {
            $addVat = $this->addVAT($customerCountry, $customerType, $customerTaxNumber);
        }


        if ($nettoValue > 0) {
            if ($addVat && $tax && $tax->getCalculationType() == TaxInterface::CALCULATION_TYPE_PERCENTAGE) {
                $grossValue = ($nettoValue * ($tax->getValue() + 100) / 100);
            } elseif ($addVat && $tax && $tax->getCalculationType() == TaxInterface::CALCULATION_TYPE_VALUE) {
                $grossValue = ($nettoValue + $tax->getValue());
            } elseif ($addVat) {
                //wyliczenie na podstawie domyślnej stawki procentowej
                $grossValue = ($nettoValue * ($this->defaultTax + 100) / 100);
            } else {
                $grossValue = $nettoValue;
            }
        }

        return [$grossValue, round($grossValue, 2)];
    }

    /**
     * The method verifies the method of calculating VAT in the basket or in another process of placing / preparing the order
     * If we do not provide the current EU VAT status, the VAT number should be verified
     *
     * @param CountryInterface|null $customerCountry
     * @param int $customerType
     * @param string|null $customerTaxNumber
     * @param bool|null $isVatUeActive
     * @return bool
     * @throws \Exception
     */
    public function addVAT(?CountryInterface $customerCountry, int $customerType, ?string $customerTaxNumber, ?bool $isVatUeActive = null)
    {
        //Warianty
        // 1. Klient to firma lub konsument z PL LUB Firma z terenu UE z nieaktywnym numerem VAT UE - naliczamy normalnie VAT- naliczamy VAT
        // 2. Firma z terenu UE z aktywnym numerem VAT UE LUB Firma lub konsument spoza UE - zwolniony z VAT- zwolniony z VAT
        if ($customerCountry
            && $customerCountry->getIsoCode() != $this->getSellerCountry()->getIsoCode()
            && $customerCountry->getIsoCode() == $this->getCountryCodeFromTaxId($customerTaxNumber)
            && $isVatUeActive === null
        ) {
            //Należy sprawdzić ważność numeru VAT UE - każdorazowo
            //Jeżeli podany numer nie pokrywa się z krajem klienta, uzajemy, że numer nie jest prawidłowy
            try {
                ini_set('default_socket_timeout', self::TIMEOUT);
                $isVatUeActive = $this->vatValidator->validateVatNumber($customerTaxNumber);
            } catch (\Exception $e) {
            }
        }
        //Warianty celowo rozpisane, zdublowane
        if ($customerCountry === null || $this->getSellerCountry() === null) {
            //Wymuszamy naliczenie VATu
            return true;
        } elseif (($customerCountry->getIsoCode() == $this->getSellerCountry()->getIsoCode())
            || ($customerType == ContractorInterface::TYPE_COMPANY && $customerCountry->getIsoCode() != $this->getSellerCountry()->getIsoCode() && $customerCountry->isUeMember() == true && !$isVatUeActive)
            || $customerType == ContractorInterface::TYPE_PRIVATE && $customerCountry->isUeMember()
        ) {
            //Wariant 1
            return true;
        } elseif ($customerType == ContractorInterface::TYPE_COMPANY && $customerCountry->isUeMember() == true && $isVatUeActive
            || !$customerCountry->isUeMember()
        ) {
            //Wariant 2
            return false;
        } else {
            return true;
        }
    }

    /**
     * @param $taxId
     * @return string|null
     */
    public function getCountryCodeFromTaxId($taxId): ?string
    {
        $countryCode = null;
        $taxId = str_replace(' ', '', $taxId);

        if ($taxId && $taxId != '' && $this->vatValidator->validateVatNumberFormat($taxId)) {
            $countryCode = self::fetchCountryCodeFromTaxId($taxId);
        }

        return $countryCode;
    }

    /**
     * @return CountryInterface|null
     * @throws \Exception
     */
    public function getSellerCountry(): ?CountryInterface
    {

        if ($this->sellerCountry instanceof CountryInterface) {
            return $this->sellerCountry;
        }

        if ($this->checkAppCountryCode && (!$this->appCountryCode || $this->appCountryCode == '')) {
            throw new \Exception('Missing seller country code symbol - add iso country code in common_config');
        } elseif (!$this->checkAppCountryCode && (!$this->appCountryCode || $this->appCountryCode == '')) {
            return null;
        }

        $sellerCountry = $this->countryManager->getRepository()->findOneBy(['code' => trim($this->appCountryCode)]);

        if (!$sellerCountry && $this->checkAppCountryCode) {
            throw new \Exception(sprintf('Seller country code %s defined in common_config does not exist in database'));
        }

        return $this->sellerCountry = $sellerCountry;
    }

    /**
     * @param CountryInterface $customerCountry
     * @param string|null $customerTaxNumber
     * @return bool
     */
    public function validateTaxIdAndCountryRelation(CountryInterface $customerCountry, ?string $customerTaxNumber): bool
    {
        if ($customerCountry
            //&& $customerCountry->isUeMember() - //disabled
            && $customerTaxNumber
            && $customerTaxNumber != ''
        ) {
            $countryCodeFetchedFromTaxNumber = TaxManager::fetchCountryCodeFromTaxId($customerTaxNumber);
            if ($countryCodeFetchedFromTaxNumber && $countryCodeFetchedFromTaxNumber != $customerCountry->getIsoCode()) {
                return false;
            }

        }

        return true;
    }

    // Static functions

    /**
     * @param null|string $taxId
     * @return string|null
     */
    public static function fetchCountryCodeFromTaxId(?string $taxId): ?string
    {
        $taxId = str_replace(' ', '', $taxId);
        $countryCode = preg_replace("/[^A-Za-z ]/", '', $taxId);

        return mb_strtoupper($countryCode);
    }

    /**
     * @param float $nettoValue
     * @param float|int $taxPercentage
     * @param bool $round
     * @param bool $ceil
     * @param int $precision
     * @return float
     */
    public static function calculateGrossValue(
        float $nettoValue,
        float|int $taxPercentage,
        bool $round = true,
        bool $ceil = false,
        int $precision = 2
    ): float {
        $grossValue = $nettoValue * ((100 + (float)$taxPercentage) / 100);

        if ($round) {
            $grossValue = round($grossValue, $precision);
        }

        if ($ceil) {
            $grossValue = ceil($grossValue);
        }

        return (float)$grossValue;
    }

    /**
     * @param float $grossValue
     * @param float|int $taxPercentage
     * @param bool $round
     * @param bool $ceil
     * @param int $precision
     * @return float
     */
    public static function calculateNettoValue(
        float $grossValue,
        float|int $taxPercentage,
        bool $round = true,
        bool $ceil = false,
        int $precision = 2
    ): float {
        $nettoValue = $grossValue / ((100 + (float)$taxPercentage) / 100);

        if ($round) {
            $nettoValue = round($nettoValue, $precision);
        }

        if ($ceil) {
            $nettoValue = ceil($nettoValue);
        }

        return (float)$nettoValue;
    }

    /**
     * Gross value calculation based on array with tax percentage => value net
     *
     * @param array $totalNettoRes
     * @param bool $addTax
     * @param bool $round
     * @param int $precision
     * @deprecated
     * @return array
     */
    public static function calculateTotalNettoAndGrossFromNettoRes(
        array $totalNettoRes,
        bool $addTax = true,
        bool $round = true,
        int $precision = 2
    ): array {
        if (count($totalNettoRes) == 0) {
            return [(float)0, (float)0];
        }

        $totalNetto = (float)0;
        $totalGross = (float)0;

        foreach ($totalNettoRes as $taxPercentage => $nettoValue) {
            $totalNetto += (float)$nettoValue;
            if ($addTax) {
                $grossValue = ($nettoValue * (100 + (float)$taxPercentage) / 100);

                if ($round) {
                    $totalGross += round($grossValue, $precision);
                } else {
                    $totalGross += $grossValue;
                }
            } else {
                $totalGross += $nettoValue;
            }
        }

        return [$totalNetto, $totalGross];
    }

    /**
     * Gross value calculation based on array with tax percentage => value net
     *
     * @param string $currencyIsoCode
     * @param array $totalNettoRes
     * @param bool $addTax
     * @param bool $round
     * @param int $precision
     * @return array
     */
    public static function calculateMoneyTotalNettoAndGrossFromNettoRes(
        string $currencyIsoCode,
        array $totalNettoRes,
        bool $addTax = true,
        bool $round = true,
        int $precision = 2
    ): array {

        $totalNetto = new Money(0, new Currency($currencyIsoCode));
        $totalGross = new Money(0, new Currency($currencyIsoCode));

        if (count($totalNettoRes) === 0) {
            return [$totalNetto, $totalGross];
        }

        /**
         * @var int $taxPercentage
         * @var Money $nettoValue
         */
        foreach ($totalNettoRes as $taxPercentage => $nettoValue) {
            $taxValue = ValueHelper::convertToValue($taxPercentage, null, $precision);
            $totalNetto->add($nettoValue);

            if ($addTax) {
                $grossValue = $nettoValue->multiply(((ValueHelper::get100Percents($precision) + (int)$taxValue->getAmount()) / ValueHelper::get100Percents($precision)));
                $totalGross->add($grossValue);
            } else {
                $totalGross->add($nettoValue);
            }
        }

        return [$totalNetto, $totalGross];
    }

    /**
     * @param string $currencyIsoCode
     * @param array $totalGrossRes
     * @param bool $addTax
     * @param int $precision
     * @return Money[]
     * @throws \Exception
     */
    public static function calculateMoneyTotalNettoAndGrossFromGrossRes(
        string $currencyIsoCode,
        array $totalGrossRes,
        bool $addTax = true,
        int $precision = 2
    ): array {
        $totalNetto = new Money(0, new Currency($currencyIsoCode));
        $totalGross = new Money(0, new Currency($currencyIsoCode));

        if (count($totalGrossRes) === 0) {
            return [$totalNetto, $totalGross];
        }

        /**
         * @var integer $taxPercentage
         * @var Money $valueGross
         */
        foreach ($totalGrossRes as $taxPercentage => $valueGross) {
            if (!$valueGross instanceof Money)
            {
                throw new \Exception('Money object is required');
            }

            $totalGross = $totalGross->add($valueGross);
            //Na tym etapie mamy wartość wyrażoną w integerach
            $taxValue = ValueHelper::intToValue($taxPercentage, null, $precision);

            if ($addTax) {
                $valueNetto = $valueGross->divide((string)((ValueHelper::get100Percents($precision) + (int)$taxValue->getAmount()) / ValueHelper::get100Percents($precision)));
                $totalNetto = $totalNetto->add($valueNetto);
            } else {
                $totalNetto = $totalNetto->add($valueGross);
            }
        }

        return [$totalNetto, $totalGross];
    }

    /**
     * Gross value calculation based on array with tax percentage => value gross
     *
     * @param array $totalGrossRes
     * @param bool $addTax
     * @param bool $round
     * @param int $precision
     * @deprecated
     * @return array
     */
    public static function calculateTotalNettoAndGrossFromGrossRes(
        array $totalGrossRes,
        bool $addTax = true,
        bool $round = true,
        int $precision = 2
    ): array {
        if (count($totalGrossRes) == 0) {
            return [(float)0, (float)0];
        }

        $totalNetto = (float)0;
        $totalGross = (float)0;

        foreach ($totalGrossRes as $taxPercentage => $valueGross) {
            $totalGross += $valueGross;
            if ($addTax) {
                $valueNetto = $valueGross / ((100 + $taxPercentage) / 100);

                if ($round) {
                    $totalNetto += round($valueNetto, $precision);
                } else {
                    $totalNetto += $valueNetto;
                }
            } else {
                $totalNetto += $valueGross;
            }


        }

        return [$totalNetto, $totalGross];
    }

    /**
     * Merges two arrays with different net rates and values
     *
     * @param array $nettoResA
     * @param array $nettoResB
     * @return array
     * @deprecated
     */
    public static function mergeNettoRes(array $nettoResA, array $nettoResB): array
    {
        $sums = [];
        foreach (array_keys($nettoResA + $nettoResB) as $key) {
            $sums[$key] = @($nettoResA[$key] + $nettoResB[$key]);
        }

        return $sums;
    }

    /**
     * @param array $nettoResA
     * @param array $nettoResB
     * @return array
     * @throws \Exception
     */
    public static function mergeMoneyNettoRes(array $nettoResA, array $nettoResB): array
    {
        $sums = [];
        foreach (array_keys($nettoResA + $nettoResB) as $key) {
            if (isset($nettoResA[$key]) && $nettoResA[$key] instanceof Money && isset($nettoResB[$key]) && $nettoResB[$key] instanceof Money) {
                $sums[$key] = $nettoResA[$key]->add($nettoResB[$key]);
            } elseif (isset($nettoResA[$key]) && $nettoResA[$key] instanceof Money) {
                $sums[$key] = $nettoResA[$key];
            } elseif (isset($nettoResB[$key]) && $nettoResB[$key] instanceof Money) {
                $sums[$key] = $nettoResB[$key];
            }
        }

        return $sums;
    }

    /**
     * @param array $grossResA
     * @param array $grossResB
     * @return array
     */
    public static function mergeRes(array $grossResA, array $grossResB): array
    {
        return self::mergeNettoRes($grossResA, $grossResB);
    }

    /**
     * @param array $grossResA
     * @param array $grossResB
     * @return array
     * @throws \Exception
     */
    public static function mergeMoneyRes(array $grossResA, array $grossResB): array
    {
        return self::mergeMoneyNettoRes($grossResA, $grossResB);
    }

    /**
     * Merges the new net worth for a specific bid
     *
     * @param float|int|null $taxPercentage
     * @param float $nettoValue
     * @param array $nettoRes
     * @return array
     * @deprecated Please use Money method addMoneyValueToNettoRes
     */
    public static function addValueToNettoRes(float|int|null $taxPercentage, float $nettoValue, array &$nettoRes): array
    {
        $taxPercentage = (string)$taxPercentage;

        if (array_key_exists($taxPercentage, $nettoRes)) {
            $nettoRes[$taxPercentage] += $nettoValue;
        } else {
            $nettoRes[$taxPercentage] = $nettoValue;
        }

        return $nettoRes;
    }

    /**
     * @param Value $taxPercentage
     * @param Money $nettoValue
     * @param array $nettoRes
     * @return void
     * @throws \Exception
     */
    public static function addMoneyValueToNettoRes(Value $taxPercentage, Money $nettoValue, array &$nettoRes): void
    {
        if (array_key_exists($taxPercentage->getAmount(), $nettoRes)) {
            $currentValue = $nettoRes[$taxPercentage->getAmount()];

            if (!$currentValue instanceof Money) {
                throw new \Exception('Money object is required!');
            }

            $nettoRes[$taxPercentage->getAmount()] = $nettoRes[$taxPercentage->getAmount()]->add($nettoValue);
        } else {
            $nettoRes[$taxPercentage->getAmount()] = $nettoValue;
        }
    }

    /**
     * Scala nową wartość netto dla konkretnej stawki
     *
     * @param float|int|null $taxPercentage
     * @param float $grossValue
     * @param array $grossRes
     * @return array
     */
    public static function addValueToGrossRes(float|int|null $taxPercentage, float $grossValue, array &$grossRes): array
    {
        return self::addValueToNettoRes($taxPercentage, $grossValue, $grossRes);
    }

    /**
     * Scala nową wartość netto dla konkretnej stawki
     *
     * @param Value $taxPercentage
     * @param Money $grossValue
     * @param array $grossRes
     * @return void
     * @throws \Exception
     */
    public static function addMoneyValueToGrossRes(Value $taxPercentage, Money $grossValue, array &$grossRes): void
    {
        self::addMoneyValueToNettoRes($taxPercentage, $grossValue, $grossRes);
    }
}
