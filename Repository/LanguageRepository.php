<?php
declare(strict_types=1);

namespace LSB\LocaleBundle\Repository;

use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;
use LSB\LocaleBundle\Entity\Language;
use LSB\UtilityBundle\Repository\BaseRepository;
use LSB\UtilityBundle\Repository\PaginationRepositoryTrait;

/**
 * Class LanguageRepository
 * @package LSB\LocaleBundle\Repository
 */
class LanguageRepository extends BaseRepository implements LanguageRepositoryInterface
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

    /**
     * @param string $code
     * @return Language|null
     * @throws NonUniqueResultException
     */
    public function getByIsoCode(string $code): ?Language
    {
        $qb = $this->createQueryBuilder('l')
            ->where('lower(l.isoCode) = lower(:code)')
            ->setParameter('code', $code);

        return $qb->getQuery()->getOneOrNullResult();
    }
}
