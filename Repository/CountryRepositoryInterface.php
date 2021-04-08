<?php
declare(strict_types=1);

namespace LSB\LocaleBundle\Repository;

use LSB\LocaleBundle\Entity\CountryInterface;
use LSB\UtilityBundle\Repository\RepositoryInterface;

/**
 * Interface CountryRepositoryInterface
 * @package LSB\LocaleBundle\Repository
 */
interface CountryRepositoryInterface extends RepositoryInterface
{
    /**
     * @param string $isoCode
     * @return CountryInterface|null
     */
    public function getByIsoCode(string $isoCode): ?CountryInterface;
    
}
