<?php
declare(strict_types=1);

namespace LSB\LocaleBundle\DependencyInjection;

use LSB\LocaleBundle\Entity\EntityInterface;
use LSB\LocaleBundle\Entity\EntityTranslationInterface;
use LSB\LocaleBundle\Factory\EntityFactory;
use LSB\LocaleBundle\Form\EntityTranslationType;
use LSB\LocaleBundle\Form\EntityType;
use LSB\LocaleBundle\LSBTemplateVendorSF5Bundle;
use LSB\LocaleBundle\Manager\EntityManager;
use LSB\LocaleBundle\Repository\EntityRepository;
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
    const CONFIG_KEY = 'lsb_template';

    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder(self::CONFIG_KEY);

        $treeBuilder
            ->getRootNode()
            ->children()
            ->scalarNode(BE::CONFIG_KEY_TRANSLATION_DOMAIN)->defaultValue((new \ReflectionClass(LSBTemplateVendorSF5Bundle::class))->getShortName())->end()
            ->arrayNode(BE::CONFIG_KEY_RESOURCES)
            ->children()
            // Start Country
                ->arrayNode('country')
                    ->addDefaultsIfNotSet()
                        ->children()
                            ->arrayNode(BE::CONFIG_KEY_CLASSES)
                                ->children()
                                    ->scalarNode(BE::CONFIG_KEY_ENTITY)->end()
                                    ->scalarNode(BE::CONFIG_KEY_INTERFACE)->defaultValue(EntityInterface::class)->end()
                                    ->scalarNode(BE::CONFIG_KEY_FACTORY)->defaultValue(EntityFactory::class)->end()
                                    ->scalarNode(BE::CONFIG_KEY_REPOSITORY)->defaultValue(EntityRepository::class)->end()
                                    ->scalarNode(BE::CONFIG_KEY_MANAGER)->defaultValue(EntityManager::class)->end()
                                    ->scalarNode(BE::CONFIG_KEY_FORM)->defaultValue(EntityType::class)->end()
                                ->end()
                            ->end()
                        ->end()
                        ->children()
                            ->arrayNode(BE::CONFIG_KEY_TRANSLATION)
                                ->children()
                                    ->scalarNode(BE::CONFIG_KEY_ENTITY)->end()
                                    ->scalarNode(BE::CONFIG_KEY_INTERFACE)->defaultValue(EntityTranslationInterface::class)->end()
                                    ->scalarNode(BE::CONFIG_KEY_FACTORY)->end()
                                    ->scalarNode(BE::CONFIG_KEY_REPOSITORY)->end()
                                    ->scalarNode(BE::CONFIG_KEY_FORM)->defaultValue(EntityTranslationType::class)->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            // End Product
            ->end()
            ->end()
            ->end();

        return $treeBuilder;
    }
}
