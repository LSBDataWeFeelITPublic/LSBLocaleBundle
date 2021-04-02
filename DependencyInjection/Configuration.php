<?php
declare(strict_types=1);

namespace LSB\LocaleBundle\DependencyInjection;

use LSB\LocaleBundle\Entity\CountryInterface;
use LSB\LocaleBundle\Entity\CountryTranslationInterface;
use LSB\LocaleBundle\Entity\CurrencyExchangeRateInterface;
use LSB\LocaleBundle\Entity\CurrencyInterface;
use LSB\LocaleBundle\Entity\LanguageInterface;
use LSB\LocaleBundle\Entity\LanguageTranslationInterface;
use LSB\LocaleBundle\Factory\CountryFactory;
use LSB\LocaleBundle\Factory\CurrencyExchangeRateFactory;
use LSB\LocaleBundle\Factory\CurrencyFactory;
use LSB\LocaleBundle\Factory\LanguageFactory;
use LSB\LocaleBundle\Form\CountryTranslationType;
use LSB\LocaleBundle\Form\CountryType;
use LSB\LocaleBundle\Form\CurrencyExchangeRateType;
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
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
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
            ->scalarNode(BE::CONFIG_KEY_TRANSLATION_DOMAIN)->defaultValue((new \ReflectionClass(LSBLocaleBundle::class))->getShortName())->end()
            ->arrayNode(BE::CONFIG_KEY_RESOURCES)
            ->children()
            // Start Country
                ->arrayNode('country')
                    ->addDefaultsIfNotSet()
                        ->children()
                            ->arrayNode(BE::CONFIG_KEY_CLASSES)
                                ->children()
                                    ->scalarNode(BE::CONFIG_KEY_ENTITY)->end()
                                    ->scalarNode(BE::CONFIG_KEY_INTERFACE)->defaultValue(CountryInterface::class)->end()
                                    ->scalarNode(BE::CONFIG_KEY_FACTORY)->defaultValue(CountryFactory::class)->end()
                                    ->scalarNode(BE::CONFIG_KEY_REPOSITORY)->defaultValue(CountryRepository::class)->end()
                                    ->scalarNode(BE::CONFIG_KEY_MANAGER)->defaultValue(CountryManager::class)->end()
                                    ->scalarNode(BE::CONFIG_KEY_FORM)->defaultValue(CountryType::class)->end()
                                ->end()
                            ->end()
                        ->end()
                        ->children()
                            ->arrayNode(BE::CONFIG_KEY_TRANSLATION)
                                ->children()
                                    ->scalarNode(BE::CONFIG_KEY_ENTITY)->end()
                                    ->scalarNode(BE::CONFIG_KEY_INTERFACE)->defaultValue(CountryTranslationInterface::class)->end()
                                    ->scalarNode(BE::CONFIG_KEY_FACTORY)->end()
                                    ->scalarNode(BE::CONFIG_KEY_REPOSITORY)->end()
                                    ->scalarNode(BE::CONFIG_KEY_FORM)->defaultValue(CountryTranslationType::class)->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            // End Country
            // Start Country
                ->arrayNode('currency')
                    ->addDefaultsIfNotSet()
                        ->children()
                            ->arrayNode(BE::CONFIG_KEY_CLASSES)
                                ->children()
                                    ->scalarNode(BE::CONFIG_KEY_ENTITY)->end()
                                    ->scalarNode(BE::CONFIG_KEY_INTERFACE)->defaultValue(CurrencyInterface::class)->end()
                                    ->scalarNode(BE::CONFIG_KEY_FACTORY)->defaultValue(CurrencyFactory::class)->end()
                                    ->scalarNode(BE::CONFIG_KEY_REPOSITORY)->defaultValue(CurrencyRepository::class)->end()
                                    ->scalarNode(BE::CONFIG_KEY_MANAGER)->defaultValue(CurrencyManager::class)->end()
                                    ->scalarNode(BE::CONFIG_KEY_FORM)->defaultValue(CurrencyType::class)->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            // End Country
             // Start Country
                ->arrayNode('currency_exchange_rate')
                    ->addDefaultsIfNotSet()
                        ->children()
                            ->arrayNode(BE::CONFIG_KEY_CLASSES)
                                ->children()
                                    ->scalarNode(BE::CONFIG_KEY_ENTITY)->end()
                                    ->scalarNode(BE::CONFIG_KEY_INTERFACE)->defaultValue(CurrencyExchangeRateInterface::class)->end()
                                    ->scalarNode(BE::CONFIG_KEY_FACTORY)->defaultValue(CurrencyExchangeRateFactory::class)->end()
                                    ->scalarNode(BE::CONFIG_KEY_REPOSITORY)->defaultValue(CurrencyExchangeRateRepository::class)->end()
                                    ->scalarNode(BE::CONFIG_KEY_MANAGER)->defaultValue(CurrencyExchangeRateManager::class)->end()
                                    ->scalarNode(BE::CONFIG_KEY_FORM)->defaultValue(CurrencyExchangeRateType::class)->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            // End Country
            // Start Country
                ->arrayNode('language')
                    ->addDefaultsIfNotSet()
                        ->children()
                            ->arrayNode(BE::CONFIG_KEY_CLASSES)
                                ->children()
                                    ->scalarNode(BE::CONFIG_KEY_ENTITY)->end()
                                    ->scalarNode(BE::CONFIG_KEY_INTERFACE)->defaultValue(LanguageInterface::class)->end()
                                    ->scalarNode(BE::CONFIG_KEY_FACTORY)->defaultValue(LanguageFactory::class)->end()
                                    ->scalarNode(BE::CONFIG_KEY_REPOSITORY)->defaultValue(LanguageRepository::class)->end()
                                    ->scalarNode(BE::CONFIG_KEY_MANAGER)->defaultValue(LanguageManager::class)->end()
                                    ->scalarNode(BE::CONFIG_KEY_FORM)->defaultValue(LanguageType::class)->end()
                                ->end()
                            ->end()
                        ->end()
                        ->children()
                            ->arrayNode(BE::CONFIG_KEY_TRANSLATION)
                                ->children()
                                    ->scalarNode(BE::CONFIG_KEY_ENTITY)->end()
                                    ->scalarNode(BE::CONFIG_KEY_INTERFACE)->defaultValue(LanguageTranslationInterface::class)->end()
                                    ->scalarNode(BE::CONFIG_KEY_FACTORY)->end()
                                    ->scalarNode(BE::CONFIG_KEY_REPOSITORY)->end()
                                    ->scalarNode(BE::CONFIG_KEY_FORM)->defaultValue(LanguageTranslationType::class)->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            // End Country
            ->end()
            ->end();

        return $treeBuilder;
    }
}
