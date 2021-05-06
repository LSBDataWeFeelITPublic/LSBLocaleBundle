<?php
declare(strict_types=1);

namespace LSB\LocaleBundle\DependencyInjection;

use LSB\LocaleBundle\Entity\Country;
use LSB\LocaleBundle\Entity\CountryInterface;
use LSB\LocaleBundle\Entity\CountryTranslation;
use LSB\LocaleBundle\Entity\CountryTranslationInterface;
use LSB\LocaleBundle\Entity\Currency;
use LSB\LocaleBundle\Entity\CurrencyExchangeRate;
use LSB\LocaleBundle\Entity\CurrencyExchangeRateInterface;
use LSB\LocaleBundle\Entity\CurrencyInterface;
use LSB\LocaleBundle\Entity\CurrencyTranslation;
use LSB\LocaleBundle\Entity\CurrencyTranslationInterface;
use LSB\LocaleBundle\Entity\Language;
use LSB\LocaleBundle\Entity\LanguageInterface;
use LSB\LocaleBundle\Entity\LanguageTranslation;
use LSB\LocaleBundle\Entity\LanguageTranslationInterface;
use LSB\LocaleBundle\Factory\CountryFactory;
use LSB\LocaleBundle\Factory\CurrencyExchangeRateFactory;
use LSB\LocaleBundle\Factory\CurrencyFactory;
use LSB\LocaleBundle\Factory\LanguageFactory;
use LSB\LocaleBundle\Form\CountryTranslationType;
use LSB\LocaleBundle\Form\CountryType;
use LSB\LocaleBundle\Form\CurrencyExchangeRateType;
use LSB\LocaleBundle\Form\CurrencyTranslationType;
use LSB\LocaleBundle\Form\CurrencyType;
use LSB\LocaleBundle\Form\LanguageTranslationType;
use LSB\LocaleBundle\Form\LanguageType;
use LSB\LocaleBundle\LSBLocaleBundle;
use LSB\LocaleBundle\Manager\CountryManager;
use LSB\LocaleBundle\Manager\CurrencyExchangeRateManager;
use LSB\LocaleBundle\Manager\CurrencyManager;
use LSB\LocaleBundle\Manager\LanguageManager;
use LSB\LocaleBundle\Repository\CountryRepository;
use LSB\LocaleBundle\Repository\CurrencyExchangeRateRepository;
use LSB\LocaleBundle\Repository\CurrencyRepository;
use LSB\LocaleBundle\Repository\LanguageRepository;
use LSB\UtilityBundle\DependencyInjection\BaseExtension as BE;
use LSB\UtilityBundle\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    const CONFIG_KEY = 'lsb_locale';

    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder(self::CONFIG_KEY);

        $treeBuilder
            ->getRootNode()
            ->children()
            ->bundleTranslationDomainScalar(LSBLocaleBundle::class)->end()
            ->resourcesNode()
            ->children()
                ->translatedResourceNode(
                    'country',
                    Country::class,
                    CountryInterface::class,
                    CountryFactory::class,
                    CountryRepository::class,
                    CountryManager::class,
                    CountryType::class,
                    CountryTranslation::class,
                    CountryTranslationInterface::class,
                    CountryTranslationType::class
                )
                ->end()
                ->translatedResourceNode(
                    'currency',
                    Currency::class,
                    CurrencyInterface::class,
                    CurrencyFactory::class,
                    CurrencyRepository::class,
                    CurrencyManager::class,
                    CurrencyType::class,
                    CurrencyTranslation::class,
                    CurrencyTranslationInterface::class,
                    CurrencyTranslationType::class
                )
                ->end()
                ->resourceNode(
                    'currency_exchange_rate',
                    CurrencyExchangeRate::class,
                    CurrencyExchangeRateInterface::class,
                    CurrencyExchangeRateFactory::class,
                    CurrencyExchangeRateRepository::class,
                    CurrencyExchangeRateManager::class,
                    CurrencyExchangeRateType::class
                )
                ->end()
                ->translatedResourceNode(
                    'language',
                    Language::class,
                    LanguageInterface::class,
                    LanguageFactory::class,
                    LanguageRepository::class,
                    LanguageManager::class,
                    LanguageType::class,
                    LanguageTranslation::class,
                    LanguageTranslationInterface::class,
                    LanguageTranslationType::class
                )
                ->end()
            ->end()
            ->end();

        return $treeBuilder;
    }
}
