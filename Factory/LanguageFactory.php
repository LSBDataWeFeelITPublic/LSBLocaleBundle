<?php
declare(strict_types=1);

namespace LSB\LocaleBundle\Factory;

use LSB\LocaleBundle\Entity\LanguageInterface;
use LSB\UtilityBundle\Factory\BaseFactory;

/**
 * Class LanguageFactory
 * @package LSB\LocaleBundle\Factory
 */
class LanguageFactory extends BaseFactory implements LanguageFactoryInterface
{

    /**
     * @return LanguageInterface
     */
    public function createNew(): LanguageInterface
    {
        return parent::createNew();
    }

}
