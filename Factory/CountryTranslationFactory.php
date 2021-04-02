<?php
declare(strict_types=1);

namespace LSB\LocaleBundle\Factory;

use LSB\LocaleBundle\Entity\CountryTranslationInterface;
use LSB\UtilityBundle\Factory\BaseFactory;

/**
 * Class CountryTranslationFactory
 * @package LSB\LocaleBundle\Factory
 */
class CountryTranslationFactory extends BaseFactory implements CountryTranslationFactoryInterface
{

    /**
     * @return CountryTranslationInterface
     */
    public function createNew(): CountryTranslationInterface
    {
        return parent::createNew();
    }

}
