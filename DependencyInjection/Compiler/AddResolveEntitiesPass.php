<?php
declare(strict_types=1);

namespace LSB\LocaleBundle\DependencyInjection\Compiler;

use LSB\LocaleBundle\DependencyInjection\Configuration;
use LSB\UtilityBundle\DependencyInjection\Compiler\BaseResolveEntitiesPass;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class AddResolveEntitiesPass
 * @package LSB\LocaleBundle\DependencyInjection\Compiler
 */
class AddResolveEntitiesPass extends BaseResolveEntitiesPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     * @throws \Exception
     */
    public function process(ContainerBuilder $container)
    {
        $this->processResources($container, Configuration::CONFIG_KEY);
    }
}
