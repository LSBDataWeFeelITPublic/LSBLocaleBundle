<?php
declare(strict_types=1);

namespace LSB\LocaleBundle\Repository;

use Doctrine\Persistence\ManagerRegistry;
use LSB\LocaleBundle\Entity\Currency;
use LSB\LocaleBundle\Entity\CurrencyInterface;
use LSB\UtilityBundle\Repository\BaseRepository;
use LSB\UtilityBundle\Repository\PaginationRepositoryTrait;

/**
 * Class CurrencyRepository
 * @package LSB\LocaleBundle\Repository
 */
class CurrencyRepository extends BaseRepository implements CurrencyRepositoryInterface
{
    use PaginationRepositoryTrait;

    /**
     * CurrencyRepository constructor.
     * @param ManagerRegistry $registry
     * @param string|null $stringClass
     */
    public function __construct(ManagerRegistry $registry, ?string $stringClass = null)
    {
        parent::__construct($registry, $stringClass ?? Currency::class);
    }

    /**
     * @return CurrencyInterface|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getDefaultCurrency(): ?CurrencyInterface
    {
        $qb = $this->createQueryBuilder('c')
            ->where('c.isDefault = TRUE')
            ->setMaxResults(1)
            ->orderBy('c.id', 'ASC');

        return $qb->getQuery()->getOneOrNullResult();
    }

}
