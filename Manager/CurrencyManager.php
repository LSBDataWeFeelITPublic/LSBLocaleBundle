<?php
declare(strict_types=1);

namespace LSB\LocaleBundle\Manager;

use LSB\LocaleBundle\Entity\CurrencyInterface;
use LSB\LocaleBundle\Factory\CurrencyFactoryInterface;
use LSB\LocaleBundle\Repository\CurrencyRepositoryInterface;
use LSB\UtilityBundle\Factory\FactoryInterface;
use LSB\UtilityBundle\Form\BaseEntityType;
use LSB\UtilityBundle\Manager\ObjectManagerInterface;
use LSB\UtilityBundle\Manager\BaseManager;
use LSB\UtilityBundle\Repository\RepositoryInterface;

/**
* Class CurrencyManager
* @package LSB\LocaleBundle\Manager
*/
class CurrencyManager extends BaseManager
{

    /**
     * CurrencyManager constructor.
     * @param ObjectManagerInterface $objectManager
     * @param CurrencyFactoryInterface $factory
     * @param CurrencyRepositoryInterface $repository
     * @param BaseEntityType|null $form
     */
    public function __construct(
        ObjectManagerInterface $objectManager,
        CurrencyFactoryInterface $factory,
        CurrencyRepositoryInterface $repository,
        ?BaseEntityType $form
    ) {
        parent::__construct($objectManager, $factory, $repository, $form);
    }

    /**
     * @return CurrencyInterface|object
     */
    public function createNew(): CurrencyInterface
    {
        return parent::createNew();
    }

    /**
     * @return CurrencyFactoryInterface|FactoryInterface
     */
    public function getFactory(): CurrencyFactoryInterface
    {
        return parent::getFactory();
    }

    /**
     * @return CurrencyRepositoryInterface|RepositoryInterface
     */
    public function getRepository(): CurrencyRepositoryInterface
    {
        return parent::getRepository();
    }
}
