<?php
declare(strict_types=1);

namespace LSB\LocaleBundle\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use LSB\LocaleBundle\Entity\CountryTranslation;
use LSB\UtilityBundle\Repository\PaginationInterface;
use LSB\UtilityBundle\Repository\PaginationRepositoryTrait;

/**
 * Class CountryTranslationRepository
 * @package LSB\LocaleBundle\Repository
 */
class CountryTranslationRepository extends ServiceEntityRepository implements CountryTranslationRepositoryInterface, PaginationInterface
{
    use PaginationRepositoryTrait;

    /**
     * CountryTranslationRepository constructor.
     * @param ManagerRegistry $registry
     * @param string|null $stringClass
     */
    public function __construct(ManagerRegistry $registry, ?string $stringClass = null)
    {
        parent::__construct($registry, $stringClass ?? CountryTranslation::class);
    }

}
