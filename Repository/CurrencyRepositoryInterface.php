<?php
declare(strict_types=1);

namespace LSB\LocaleBundle\Repository;

use LSB\LocaleBundle\Entity\CurrencyInterface;
use LSB\UtilityBundle\Repository\RepositoryInterface;

/**
 * Interface CurrencyRepositoryInterface
 * @package LSB\LocaleBundle\Repository
 */
interface CurrencyRepositoryInterface extends RepositoryInterface
{
    /**
     * @return CurrencyInterface|null
     */
    public function getDefaultCurrency(): ?CurrencyInterface;
}
