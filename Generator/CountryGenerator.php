<?php
declare(strict_types=1);

namespace LSB\LocaleBundle\Generator;

use LSB\LocaleBundle\Entity\CountryInterface;
use LSB\LocaleBundle\Manager\CountryManager;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CountryGenerator
 * @package LSB\LocaleBundle\Generator
 */
class CountryGenerator
{
    const DICTIONARY_FOLDER = 'Dict';
    const DICTIONARY_FILE_COUNTRIES = 'countries';
    const DICTIONARY_FILE_EXTENSION = 'json';
    const FILE_CODE_PL = 'PL';
    const FILE_CODE_EN = 'EN';
    const FILE_CODE_UE = 'UE';

    protected CountryManager $countryManager;

    protected array $countriesPL = [];

    protected array $countriesEN = [];

    protected array $countriesUE = [];

    /**
     * CountryGenerator constructor.
     * @param CountryManager $countryManager
     */
    public function __construct(CountryManager $countryManager)
    {
        $this->countryManager = $countryManager;
    }

    /**
     * Fetch countries from dictionaries
     *
     * @param string $languageCode
     * @return array
     */
    protected function fetchCountries(string $languageCode): array
    {
        $resourceName = self::DICTIONARY_FILE_COUNTRIES . mb_strtoupper($languageCode) . "." . self::DICTIONARY_FILE_EXTENSION;
        $resourcePath = __DIR__ . DIRECTORY_SEPARATOR . self::DICTIONARY_FOLDER . DIRECTORY_SEPARATOR . $resourceName;

        $content = [];

        if (file_exists($resourcePath)) {
            $content = file_get_contents($resourcePath);
            $content = json_decode($content, true);
        } else {
            throw new \Exception("File $resourcePath not exsts.");
        }

        if (!(is_array($content) && count($content) > 0)) {
            throw new \Exception('Wrong data. Array required.');
        }

        return $content;
    }


    /**
     * @param OutputInterface $output
     * @throws \Exception
     */
    public function importCountries(OutputInterface $output): void
    {
        //Fetch countries (PL)
        $this->countriesPL = $this->fetchCountries(self::FILE_CODE_PL);
        //Fetch countries (EN)
        $this->countriesEN = $this->fetchCountries(self::FILE_CODE_EN);
        //Fetch UE countries
        $this->countriesUE = $this->fetchCountries(self::FILE_CODE_EN);

        $output->writeln(sprintf('Fetched %d countries, including %d UE countries', count($this->countriesPL), count($this->countriesUE)));

        /**
         * @var string $name
         * @car string $isoCode
         */
        foreach ($this->countriesEN as $isoCode => $name) {
            //Sprawdzamy czy kraj już istnieje
            $country = $this->countryManager->getRepository()->getByIsoCode($isoCode);

            if ($country instanceof CountryInterface) {
                $output->writeln(sprintf("Country %s already exists, with id: %d", $name, $country->getId()));
            } else {
                $country = $this->countryManager->createNew();
                $output->writeln(sprintf("Creating new country: %s", $name));
            }

            $country
                ->setIsoCode($isoCode)
                ->translate('en')
                ->setName($name);

            $countryNamePL = array_key_exists($isoCode, $this->countriesPL) ? $this->countriesPL[$isoCode] : null;
            $country->translate('pl')->setName($countryNamePL);

            $country->setIsUeMember(array_key_exists($isoCode, $this->countriesUE));
            $this->countryManager->persist($country);
        }

        $this->countryManager->flush();
        $output->writeln('Flush...');
        $output->writeln('Done');
    }

}