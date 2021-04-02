<?php
declare(strict_types=1);

namespace LSB\LocaleBundle\Factory;

use LSB\LocaleBundle\Entity\CurrencyExchangeRateInterface;
use LSB\UtilityBundle\Factory\BaseFactory;

/**
 * Class CurrencyExchangeRateFactory
 * @package LSB\LocaleBundle\Factory
 */
class CurrencyExchangeRateFactory extends BaseFactory implements CurrencyExchangeRateFactoryInterface
{

    /**
     * @return CurrencyExchangeRateInterface
     */
    public function createNew(): CurrencyExchangeRateInterface
    {
        return parent::createNew();
    }

}
