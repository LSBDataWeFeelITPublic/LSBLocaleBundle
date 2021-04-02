<?php
declare(strict_types=1);

namespace LSB\LocaleBundle\Factory;

use LSB\LocaleBundle\Entity\CurrencyInterface;
use LSB\UtilityBundle\Factory\BaseFactory;

/**
 * Class CurrencyFactory
 * @package LSB\LocaleBundle\Factory
 */
class CurrencyFactory extends BaseFactory implements CurrencyFactoryInterface
{

    /**
     * @return CurrencyInterface
     */
    public function createNew(): CurrencyInterface
    {
        return parent::createNew();
    }

}
