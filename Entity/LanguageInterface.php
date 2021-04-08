<?php
declare(strict_types=1);

namespace LSB\LocaleBundle\Entity;


use LSB\UtilityBundle\Interfaces\UuidInterface;

/**
 * Interface LanguageInterface
 * @package LSB\LocaleBundle\Entity
 */
interface LanguageInterface extends UuidInterface
{
    /**
     * @return string
     */
    public function getIsoCode(): string;

    /**
     * @param string $isoCode
     * @return $this
     */
    public function setIsoCode(string $isoCode): self;

    /**
     * @return bool
     */
    public function isEnabled(): bool;

    /**
     * @param bool $isEnabled
     * @return $this
     */
    public function setIsEnabled(bool $isEnabled): self;

    /**
     * @return bool
     */
    public function isDefault(): bool;

    /**
     * @param bool $isDefault
     * @return $this
     */
    public function setIsDefault(bool $isDefault): self;
}