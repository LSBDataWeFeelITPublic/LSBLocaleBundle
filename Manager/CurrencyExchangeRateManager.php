<?php
declare(strict_types=1);

namespace LSB\LocaleBundle\Manager;

use LSB\LocaleBundle\Entity\CurrencyExchangeRateInterface;
use LSB\LocaleBundle\Factory\CurrencyExchangeRateFactoryInterface;
use LSB\LocaleBundle\Repository\CurrencyExchangeRateRepositoryInterface;
use LSB\UtilityBundle\Factory\FactoryInterface;
use LSB\UtilityBundle\Form\BaseEntityType;
use LSB\UtilityBundle\Manager\ObjectManagerInterface;
use LSB\UtilityBundle\Manager\BaseManager;
use LSB\UtilityBundle\Repository\RepositoryInterface;

/**
* Class CurrencyExchangeRateManager
* @package LSB\LocaleBundle\Manager
*/
class CurrencyExchangeRateManager extends BaseManager
{

    /**
     * CurrencyExchangeRateManager constructor.
     * @param ObjectManagerInterface $objectManager
     * @param CurrencyExchangeRateFactoryInterface $factory
     * @param CurrencyExchangeRateRepositoryInterface $repository
     * @param BaseEntityType|null $form
     */
    public function __construct(
        ObjectManagerInterface $objectManager,
        CurrencyExchangeRateFactoryInterface $factory,
        CurrencyExchangeRateRepositoryInterface $repository,
        ?BaseEntityType $form
    ) {
        parent::__construct($objectManager, $factory, $repository, $form);
    }

    /**
     * @return CurrencyExchangeRateInterface|object
     */
    public function createNew(): CurrencyExchangeRateInterface
    {
        return parent::createNew();
    }

    /**
     * @return CurrencyExchangeRateFactoryInterface|FactoryInterface
     */
    public function getFactory(): CurrencyExchangeRateFactoryInterface
    {
        return parent::getFactory();
    }

    /**
     * @return CurrencyExchangeRateRepositoryInterface|RepositoryInterface
     */
    public function getRepository(): CurrencyExchangeRateRepositoryInterface
    {
        return parent::getRepository();
    }
}
