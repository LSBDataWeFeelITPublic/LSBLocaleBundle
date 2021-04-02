<?php

namespace LSB\LocaleBundle\Entity;


/**
 * Interface LanguageInterface
 * @package LSB\LocaleBundle\Entity
 */
interface LanguageInterface
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
     * @return string|null
     */
    public function getSlug(): ?string;

    /**
     * @param string|null $slug
     * @return $this
     */
    public function setSlug(?string $slug): self;

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