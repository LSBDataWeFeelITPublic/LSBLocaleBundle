<?php
declare(strict_types=1);

namespace LSB\LocaleBundle\Manager;

use LSB\LocaleBundle\Entity\LanguageInterface;
use LSB\LocaleBundle\Factory\LanguageFactoryInterface;
use LSB\LocaleBundle\Repository\LanguageRepositoryInterface;
use LSB\UtilityBundle\Factory\FactoryInterface;
use LSB\UtilityBundle\Form\BaseEntityType;
use LSB\UtilityBundle\Manager\ObjectManagerInterface;
use LSB\UtilityBundle\Manager\BaseManager;
use LSB\UtilityBundle\Repository\RepositoryInterface;

/**
* Class LanguageManager
* @package LSB\LocaleBundle\Manager
*/
class LanguageManager extends BaseManager
{

    /**
     * LanguageManager constructor.
     * @param ObjectManagerInterface $objectManager
     * @param LanguageFactoryInterface $factory
     * @param LanguageRepositoryInterface $repository
     * @param BaseEntityType|null $form
     */
    public function __construct(
        ObjectManagerInterface $objectManager,
        LanguageFactoryInterface $factory,
        LanguageRepositoryInterface $repository,
        ?BaseEntityType $form
    ) {
        parent::__construct($objectManager, $factory, $repository, $form);
    }

    /**
     * @return LanguageInterface|object
     */
    public function createNew(): LanguageInterface
    {
        return parent::createNew();
    }

    /**
     * @return LanguageFactoryInterface|FactoryInterface
     */
    public function getFactory(): LanguageFactoryInterface
    {
        return parent::getFactory();
    }

    /**
     * @return LanguageRepositoryInterface|RepositoryInterface
     */
    public function getRepository(): LanguageRepositoryInterface
    {
        return parent::getRepository();
    }
}
