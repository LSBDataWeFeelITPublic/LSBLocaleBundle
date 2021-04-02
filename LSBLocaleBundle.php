<?php
declare(strict_types=1);

namespace LSB\LocaleBundle;

use LSB\LocaleBundle\DependencyInjection\Compiler\AddManagerResourcePass;
use LSB\LocaleBundle\DependencyInjection\Compiler\AddResolveEntitiesPass;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class LSBLocaleBundle
 * @package LSB\TemplateVendorSF5Bundle
 */
class LSBLocaleBundle extends Bundle
{
    /**
     * @param ContainerBuilder $builder
     */
    public function build(ContainerBuilder $builder)
    {
        parent::build($builder);

        $builder
            ->addCompilerPass(new AddManagerResourcePass())
            ->addCompilerPass(new AddResolveEntitiesPass(), PassConfig::TYPE_BEFORE_OPTIMIZATION, 1);
        ;
    }
}
