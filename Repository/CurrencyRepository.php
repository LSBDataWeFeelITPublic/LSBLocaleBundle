<?php
declare(strict_types=1);

namespace LSB\LocaleBundle\Repository;

use Doctrine\Persistence\ManagerRegistry;
use LSB\LocaleBundle\Entity\Currency;
use LSB\UtilityBundle\Repository\BaseRepository;
use LSB\UtilityBundle\Repository\PaginationInterface;
use LSB\UtilityBundle\Repository\PaginationRepositoryTrait;

/**
 * Class CurrencyRepository
 * @package LSB\LocaleBundle\Repository
 */
class CurrencyRepository extends BaseRepository implements CurrencyRepositoryInterface, PaginationInterface
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

}
