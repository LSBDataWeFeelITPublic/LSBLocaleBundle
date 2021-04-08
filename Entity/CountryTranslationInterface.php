<?php
declare(strict_types=1);

namespace LSB\LocaleBundle\Entity;

use LSB\UtilityBundle\Interfaces\IdInterface;

/**
 *
 * Class CountryTranslation
 * @package LSB\LocaleBundle\Entity
 */
interface CountryTranslationInterface extends IdInterface
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