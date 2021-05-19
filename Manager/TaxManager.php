<?php
declare(strict_types=1);

namespace LSB\LocaleBundle\Manager;

use LSB\LocaleBundle\Entity\TaxInterface;
use LSB\LocaleBundle\Factory\TaxFactoryInterface;
use LSB\LocaleBundle\Repository\TaxRepositoryInterface;
use LSB\UtilityBundle\Factory\FactoryInterface;
use LSB\UtilityBundle\Form\BaseEntityType;
use LSB\UtilityBundle\Manager\ObjectManagerInterface;
use LSB\UtilityBundle\Manager\BaseManager;
use LSB\UtilityBundle\Repository\RepositoryInterface;

/**
* Class TaxManager
* @package LSB\LocaleBundle\Manager
*/
class TaxManager extends BaseManager
{

    /**
     * TaxManager constructor.
     * @param ObjectManagerInterface $objectManager
     * @param TaxFactoryInterface $factory
     * @param TaxRepositoryInterface $repository
     * @param BaseEntityType|null $form
     */
    public function __construct(
        ObjectManagerInterface $objectManager,
        TaxFactoryInterface $factory,
        TaxRepositoryInterface $repository,
        ?BaseEntityType $form
    ) {
        parent::__construct($objectManager, $factory, $repository, $form);
    }

    /**
     * @return TaxInterface|object
     */
    public function createNew(): TaxInterface
    {
        return parent::createNew();
    }

    /**
     * @return TaxFactoryInterface|FactoryInterface
     */
    public function getFactory(): TaxFactoryInterface
    {
        return parent::getFactory();
    }

    /**
     * @return TaxRepositoryInterface|RepositoryInterface
     */
    public function getRepository(): TaxRepositoryInterface
    {
        return parent::getRepository();
    }
}
