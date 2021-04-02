<?php
declare(strict_types=1);

namespace LSB\LocaleBundle\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use LSB\LocaleBundle\Entity\LanguageTranslation;
use LSB\UtilityBundle\Repository\PaginationInterface;
use LSB\UtilityBundle\Repository\PaginationRepositoryTrait;

/**
 * Class LanguageTranslationRepository
 * @package LSB\LocaleBundle\Repository
 */
class LanguageTranslationRepository extends ServiceEntityRepository implements LanguageTranslationRepositoryInterface, PaginationInterface
{
    use PaginationRepositoryTrait;

    /**
     * LanguageTranslationRepository constructor.
     * @param ManagerRegistry $registry
     * @param string|null $stringClass
     */
    public function __construct(ManagerRegistry $registry, ?string $stringClass = null)
    {
        parent::__construct($registry, $stringClass ?? LanguageTranslation::class);
    }

}
