<?php
declare(strict_types=1);

namespace LSB\LocaleBundle\Repository;

use Doctrine\Persistence\ManagerRegistry;
use LSB\LocaleBundle\Entity\CurrencyTranslation;
use LSB\UtilityBundle\Repository\BaseRepository;
use LSB\UtilityBundle\Repository\PaginationRepositoryTrait;

/**
 * Class CurrencyTranslationRepository
 * @package LSB\LocaleBundle\Repository
 */
class CurrencyTranslationRepository extends BaseRepository implements CurrencyTranslationRepositoryInterface
{
    use PaginationRepositoryTrait;

    /**
     * CountryTranslationRepository constructor.
     * @param ManagerRegistry $registry
     * @param string|null $stringClass
     */
    public function __construct(ManagerRegistry $registry, ?string $stringClass = null)
    {
        parent::__construct($registry, $stringClass ?? CurrencyTranslation::class);
    }

}
