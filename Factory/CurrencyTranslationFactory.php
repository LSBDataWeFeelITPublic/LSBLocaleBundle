<?php
declare(strict_types=1);

namespace LSB\LocaleBundle\Factory;

use LSB\LocaleBundle\Entity\CurrencyTranslationInterface;
use LSB\UtilityBundle\Factory\BaseFactory;

/**
 * Class CurrencyTranslationFactory
 * @package LSB\LocaleBundle\Factory
 */
class CurrencyTranslationFactory extends BaseFactory implements CountryTranslationFactoryInterface
{
    /**
     * @return CurrencyTranslationInterface
     */
    public function createNew(): CurrencyTranslationInterface
    {
        return parent::createNew();
    }

}
