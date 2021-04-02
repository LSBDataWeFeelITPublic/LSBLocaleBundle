<?php
declare(strict_types=1);

namespace LSB\LocaleBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\MappedSuperclass;
use LSB\UtilityBundle\Traits\CreatedUpdatedTrait;
use LSB\UtilityBundle\Traits\UuidTrait;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class CurrencyExchangeRate
 * @package LSB\LocaleBundle\Entity
 * @MappedSuperclass
 */
class CurrencyExchangeRate implements CurrencyExchangeRateInterface
{
    use UuidTrait;
    use CreatedUpdatedTrait;

    const TYPE_AVERAGE = 1;

    /**
     * @ORM\ManyToOne(targetEntity="LSB\LocaleBundle\Entity\CurrencyInterface")
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    protected CurrencyInterface $currency;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     * @Assert\Length(max="5")
     */
    protected string $currencyIsoCode;

    /**
     * @ORM\ManyToOne(targetEntity="LSB\LocaleBundle\Entity\CurrencyInterface")
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    protected CurrencyInterface $targetCurrency;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     * @Assert\Length(max="5")
     */
    protected string $targetCurrencyIsoCode;

    /**
     * @var float|string
     *
     * @ORM\Column(type="decimal", precision=18, scale=4, nullable=false)
     * @Assert\Type(type="numeric")
     */
    protected $exchangeRate;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     * @Assert\DateTime()
     */
    protected DateTime $exchangeRateDate;


    /**
     * @ORM\Column(type="integer", nullable=false, options={"default": 1})
     */
    protected int $type = self::TYPE_AVERAGE;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected ?string $dataSource;

    /**
     * CurrencyExchangeRate constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->generateUuid();
    }

    /**
     * @throws \Exception
     */
    public function __clone()
    {
        $this->id = null;
        $this->generateUuid(true);
    }

    /**
     * @return CurrencyInterface
     */
    public function getCurrency(): CurrencyInterface
    {
        return $this->currency;
    }

    /**
     * @param CurrencyInterface $currency
     * @return $this
     */
    public function setCurrency(CurrencyInterface $currency): self
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrencyIsoCode(): string
    {
        return $this->currencyIsoCode;
    }

    /**
     * @param string $currencyIsoCode
     * @return $this
     */
    public function setCurrencyIsoCode(string $currencyIsoCode): self
    {
        $this->currencyIsoCode = $currencyIsoCode;
        return $this;
    }

    /**
     * @return CurrencyInterface
     */
    public function getTargetCurrency(): CurrencyInterface
    {
        return $this->targetCurrency;
    }

    /**
     * @param CurrencyInterface $targetCurrency
     * @return $this
     */
    public function setTargetCurrency(CurrencyInterface $targetCurrency): self
    {
        $this->targetCurrency = $targetCurrency;
        return $this;
    }

    /**
     * @return string
     */
    public function getTargetCurrencyIsoCode(): string
    {
        return $this->targetCurrencyIsoCode;
    }

    /**
     * @param string $targetCurrencyIsoCode
     * @return $this
     */
    public function setTargetCurrencyIsoCode(string $targetCurrencyIsoCode): self
    {
        $this->targetCurrencyIsoCode = $targetCurrencyIsoCode;
        return $this;
    }

    /**
     * @return float|string
     */
    public function getExchangeRate()
    {
        return $this->exchangeRate;
    }

    /**
     * @param float|string $exchangeRate
     * @return $this
     */
    public function setExchangeRate($exchangeRate)
    {
        $this->exchangeRate = $exchangeRate;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getExchangeRateDate(): DateTime
    {
        return $this->exchangeRateDate;
    }

    /**
     * @param DateTime $exchangeRateDate
     * @return $this
     */
    public function setExchangeRateDate(DateTime $exchangeRateDate): self
    {
        $this->exchangeRateDate = $exchangeRateDate;
        return $this;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @param int $type
     * @return $this
     */
    public function setType(int $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDataSource(): ?string
    {
        return $this->dataSource;
    }

    /**
     * @param string|null $dataSource
     * @return $this
     */
    public function setDataSource(?string $dataSource): self
    {
        $this->dataSource = $dataSource;
        return $this;
    }
}
