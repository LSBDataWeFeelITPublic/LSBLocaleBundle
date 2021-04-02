<?php
declare(strict_types=1);

namespace LSB\LocaleBundle\Manager;

use LSB\LocaleBundle\Entity\CountryInterface;
use LSB\LocaleBundle\Factory\CountryFactoryInterface;
use LSB\LocaleBundle\Repository\CountryRepositoryInterface;
use LSB\UtilityBundle\Factory\FactoryInterface;
use LSB\UtilityBundle\Form\BaseEntityType;
use LSB\UtilityBundle\Manager\ObjectManagerInterface;
use LSB\UtilityBundle\Manager\BaseManager;
use LSB\UtilityBundle\Repository\RepositoryInterface;

/**
* Class CountryManager
* @package LSB\LocaleBundle\Manager
*/
class CountryManager extends BaseManager
{

    /**
     * CountryManager constructor.
     * @param ObjectManagerInterface $objectManager
     * @param CountryFactoryInterface $factory
     * @param CountryRepositoryInterface $repository
     * @param BaseEntityType|null $form
     */
    public function __construct(
        ObjectManagerInterface $objectManager,
        CountryFactoryInterface $factory,
        CountryRepositoryInterface $repository,
        ?BaseEntityType $form
    ) {
        parent::__construct($objectManager, $factory, $repository, $form);
    }

    /**
     * @return CountryInterface|object
     */
    public function createNew(): CountryInterface
    {
        return parent::createNew();
    }

    /**
     * @return CountryFactoryInterface|FactoryInterface
     */
    public function getFactory(): CountryFactoryInterface
    {
        return parent::getFactory();
    }

    /**
     * @return CountryRepositoryInterface|RepositoryInterface
     */
    public function getRepository(): CountryRepositoryInterface
    {
        return parent::getRepository();
    }
}
