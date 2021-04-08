<?php
declare(strict_types=1);

namespace LSB\LocaleBundle\Entity;

use LSB\UtilityBundle\Interfaces\UuidInterface;

/**
 * Interface CurrencyInterface
 * @package LSB\LocaleBundle\Entity
 */
interface CurrencyInterface extends UuidInterface
{

    /**
     * @return string
     */
    public function getIsoCode(): string;

    /**
     * @param string $isoCode
     * @return Currency
     */
    public function setIsoCode(string $isoCode): Currency;

    /**
     * @return int|null
     */
    public function getPosition(): ?int;

    /**
     * @param int $position
     * @return Currency
     */
    public function setPosition(?int $position): Currency;

    /**
     * @return bool
     */
    public function isDefault(): bool;

    /**
     * @param bool $isDefault
     * @return Currency
     */
    public function setIsDefault(bool $isDefault): Currency;
}