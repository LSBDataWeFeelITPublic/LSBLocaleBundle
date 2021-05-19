<?php
declare(strict_types=1);

namespace LSB\LocaleBundle\Entity;

use DateTime;
use LSB\UtilityBundle\Interfaces\UuidInterface;

/**
 * Interface TaxInterface
 * @package LSB\LocaleBundle\Entity
 */
interface TaxInterface extends UuidInterface
{
    const TYPE_VAT = 10;
    const TYPE_CUSTOMS = 20;

    const CALCULATION_TYPE_PERCENTAGE = 10;
    const CALCULATION_TYPE_VALUE = 20;

    /**
     * @return bool
     */
    public function isDefault(): bool;

    /**
     * @param int $type
     * @return $this
     */
    public function setType(int $type): self;

    /**
     * @param bool $isEnabled
     * @return $this
     */
    public function setIsEnabled(bool $isEnabled): self;

    /**
     * @param float|null $value
     * @return $this
     */
    public function setValue(?float $value): self;

    /**
     * @return int
     */
    public function getCalculationType(): int;

    /**
     * @param DateTime|null $dateTo
     * @return $this
     */
    public function setDateTo(?DateTime $dateTo): self;

    /**
     * @return DateTime|null
     */
    public function getDateFrom(): ?DateTime;

    /**
     * @return bool
     */
    public function isEnabled(): bool;

    /**
     * @param DateTime|null $dateFrom
     * @return $this
     */
    public function setDateFrom(?DateTime $dateFrom): self;

    /**
     * @param int $calculationType
     * @return $this
     */
    public function setCalculationType(int $calculationType): self;

    /**
     * @return CountryInterface
     */
    public function getCountry(): CountryInterface;

    /**
     * @param CountryInterface $country
     * @return $this
     */
    public function setCountry(CountryInterface $country): self;

    /**
     * @return float|null
     */
    public function getValue(): ?float;

    /**
     * @param bool $isDefault
     * @return $this
     */
    public function setIsDefault(bool $isDefault): self;

    /**
     * @return DateTime|null
     */
    public function getDateTo(): ?DateTime;

    /**
     * @return int
     */
    public function getType(): int;
}