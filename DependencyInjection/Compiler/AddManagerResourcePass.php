<?php
declare(strict_types=1);

namespace LSB\LocaleBundle\DependencyInjection\Compiler;

use LSB\LocaleBundle\DependencyInjection\Configuration;
use LSB\UtilityBundle\DependencyInjection\Compiler\BaseManagerResourcePass;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class AddManagerResourcePass
 * @package LSB\LocaleBundle\DependencyInjection\Compiler
 */
class AddManagerResourcePass extends BaseManagerResourcePass implements CompilerPassInterface
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
