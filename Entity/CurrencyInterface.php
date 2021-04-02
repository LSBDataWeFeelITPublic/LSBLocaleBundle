<?php
declare(strict_types=1);

namespace LSB\LocaleBundle\Entity;

/**
 * Interface CurrencyInterface
 * @package LSB\LocaleBundle\Entity
 */
interface CurrencyInterface
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $name
     * @return Currency
     */
    public function setName(string $name): Currency;

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
     * @return int
     */
    public function getPosition(): int;

    /**
     * @param int $position
     * @return Currency
     */
    public function setPosition(int $position): Currency;

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