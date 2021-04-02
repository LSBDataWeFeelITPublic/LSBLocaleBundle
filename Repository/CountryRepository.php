<?php
declare(strict_types=1);

namespace LSB\LocaleBundle\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use LSB\LocaleBundle\Entity\Country;
use LSB\UtilityBundle\Repository\PaginationInterface;
use LSB\UtilityBundle\Repository\PaginationRepositoryTrait;

/**
 * Class CountryRepository
 * @package LSB\LocaleBundle\Repository
 */
class CountryRepository extends ServiceEntityRepository implements CountryRepositoryInterface, PaginationInterface
{
    use PaginationRepositoryTrait;

    /**
     * CountryRepository constructor.
     * @param ManagerRegistry $registry
     * @param string|null $stringClass
     */
    public function __construct(ManagerRegistry $registry, ?string $stringClass = null)
    {
        parent::__construct($registry, $stringClass ?? Country::class);
    }

}
