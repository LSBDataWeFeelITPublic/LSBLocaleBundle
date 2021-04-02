<?php
declare(strict_types=1);

namespace LSB\LocaleBundle\Entity;

/**
 * Interface LanguageTranslationInterface
 * @package LSB\LocaleBundle\Entity
 */
interface LanguageTranslationInterface
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