<?php
declare(strict_types=1);

namespace LSB\LocaleBundle\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use LSB\LocaleBundle\Entity\Language;
use LSB\UtilityBundle\Repository\PaginationInterface;
use LSB\UtilityBundle\Repository\PaginationRepositoryTrait;

/**
 * Class LanguageRepository
 * @package LSB\LocaleBundle\Repository
 */
class LanguageRepository extends ServiceEntityRepository implements LanguageRepositoryInterface, PaginationInterface
{
    use PaginationRepositoryTrait;

    /**
     * LanguageRepository constructor.
     * @param ManagerRegistry $registry
     * @param string|null $stringClass
     */
    public function __construct(ManagerRegistry $registry, ?string $stringClass = null)
    {
        parent::__construct($registry, $stringClass ?? Language::class);
    }

}
