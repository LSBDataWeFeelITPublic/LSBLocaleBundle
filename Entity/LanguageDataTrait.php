<?php

namespace LSB\LocaleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;

/**
 * Trait LanguageDataTrait
 * @package LSB\LocaleBundle\Entity
 */
trait LanguageDataTrait
{

    /**
     * Kod języka
     *
     * @var string|null
     *
     * @ORM\Column(type="string", length=30, nullable=true)
     * @Assert\Length(
     *     max="30",
     *     groups={"Default"}
     * )
     */
    protected $languageCode;

    /**
     * Język
     *
     * @var Language|null
     *
     * @ORM\ManyToOne(targetEntity="LSB\LocaleBundle\Entity\Language")
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    protected $language;

    /**
     * @param Language|null $language
     * @return $this
     */
    public function setLanguage(Language $language = null): self
    {
        $this->languageCode = $language ? $language->getCode() : null;

        $this->language = $language;

        return $this;
    }

    /**
     * @return Language|null
     */
    public function getLanguage(): ?Language
    {
        return $this->language;
    }

    /**
     * @param $languageCode
     * @return $this
     */
    public function setLanguageCode($languageCode): self
    {
        $this->languageCode = $languageCode;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLanguageCode(): ?string
    {
        return $this->languageCode;
    }
}
