<?php
declare(strict_types=1);

namespace LSB\LocaleBundle\Repository;

use Doctrine\Persistence\ManagerRegistry;
use LSB\LocaleBundle\Entity\CurrencyExchangeRate;
use LSB\UtilityBundle\Repository\BaseRepository;
use LSB\UtilityBundle\Repository\PaginationInterface;
use LSB\UtilityBundle\Repository\PaginationRepositoryTrait;

/**
 * Class CurrencyExchangeRateRepository
 * @package LSB\LocaleBundle\Repository
 */
class CurrencyExchangeRateRepository extends BaseRepository implements CurrencyExchangeRateRepositoryInterface, PaginationInterface
{
    use PaginationRepositoryTrait;

    /**
     * CurrencyExchangeRateRepository constructor.
     * @param ManagerRegistry $registry
     * @param string|null $stringClass
     */
    public function __construct(ManagerRegistry $registry, ?string $stringClass = null)
    {
        parent::__construct($registry, $stringClass ?? CurrencyExchangeRate::class);
    }

}
