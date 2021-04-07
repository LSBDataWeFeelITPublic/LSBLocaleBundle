<?php
declare(strict_types=1);

namespace LSB\LocaleBundle\Entity;

/**
 * Interface CurrencyTranslationInterface
 * @package LSB\LocaleBundle\Entity
 */
interface CurrencyTranslationInterface
{
    /**
     * @return string|null
     */
    public function getName(): ?string;

    /**
     * @param string|null $name
     * @return $this
     */
    public function setName(?string $name): self;
}