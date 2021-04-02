<?php
declare(strict_types=1);

namespace LSB\LocaleBundle\Factory;

use LSB\LocaleBundle\Entity\LanguageTranslationInterface;
use LSB\UtilityBundle\Factory\BaseFactory;

/**
 * Class LanguageTranslationFactory
 * @package LSB\LocaleBundle\Factory
 */
class LanguageTranslationFactory extends BaseFactory implements LanguageTranslationFactoryInterface
{

    /**
     * @return LanguageTranslationInterface
     */
    public function createNew(): LanguageTranslationInterface
    {
        return parent::createNew();
    }

}
