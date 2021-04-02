<?php
declare(strict_types=1);

namespace LSB\LocaleBundle\Factory;

use LSB\LocaleBundle\Entity\CountryInterface;
use LSB\UtilityBundle\Factory\BaseFactory;

/**
 * Class CountryFactory
 * @package LSB\LocaleBundle\Factory
 */
class CountryFactory extends BaseFactory implements CountryFactoryInterface
{

    /**
     * @return CountryInterface
     */
    public function createNew(): CountryInterface
    {
        return parent::createNew();
    }

}
