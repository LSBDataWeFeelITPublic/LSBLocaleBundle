<?php
declare(strict_types=1);

namespace LSB\LocaleBundle\Entity;

/**
 * Interface CountryInterface
 * @package LSB\LocaleBundle\Entity
 */
interface CountryInterface
{
    /**
     * @return mixed
     */
    public function getIsoCode();

    /**
     * @param mixed $isoCode
     * @return $this
     */
    public function setIsoCode($isoCode);

    /**
     * @return LanguageInterface|null
     */
    public function getDefaultLanguage(): ?LanguageInterface;

    /**
     * @param LanguageInterface|null $defaultLanguage
     * @return $this
     */
    public function setDefaultLanguage(?LanguageInterface $defaultLanguage): self;

    /**
     * @return CurrencyInterface|null
     */
    public function getDefaultCurrency(): ?CurrencyInterface;

    /**
     * @param CurrencyInterface|null $defaultCurrency
     * @return $this
     */
    public function setDefaultCurrency(?CurrencyInterface $defaultCurrency): self;

    /**
     * @return bool
     */
    public function isUeMember(): bool;

    /**
     * @param bool $isUeMember
     * @return $this
     */
    public function setIsUeMember(bool $isUeMember): self;

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