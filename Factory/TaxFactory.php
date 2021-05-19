<?php
declare(strict_types=1);

namespace LSB\LocaleBundle\Factory;

use LSB\LocaleBundle\Entity\TaxInterface;
use LSB\UtilityBundle\Factory\BaseFactory;

/**
 * Class TaxFactory
 * @package LSB\LocaleBundle\Factory
 */
class TaxFactory extends BaseFactory implements TaxFactoryInterface
{

    /**
     * @return TaxInterface
     */
    public function createNew(): TaxInterface
    {
        return parent::createNew();
    }

}
