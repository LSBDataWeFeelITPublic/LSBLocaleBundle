<?php
declare(strict_types=1);

namespace LSB\LocaleBundle\Repository;

use Doctrine\Persistence\ManagerRegistry;
use LSB\LocaleBundle\Entity\Country;
use LSB\LocaleBundle\Entity\CountryInterface;
use LSB\UtilityBundle\Repository\BaseRepository;
use LSB\UtilityBundle\Repository\PaginationRepositoryTrait;

/**
 * Class CountryRepository
 * @package LSB\LocaleBundle\Repository
 */
class CountryRepository extends BaseRepository implements CountryRepositoryInterface
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

    /**
     * @param string $isoCode
     * @return CountryInterface|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getByIsoCode(string $isoCode): ?CountryInterface
    {
        $qb = $this->createQueryBuilder('c')
            ->where('lower(c.isoCode) LIKE lower(:isoCode)')
            ->setParameter('isoCode',$isoCode)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }

}
