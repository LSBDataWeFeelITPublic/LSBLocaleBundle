<?php
declare(strict_types=1);

namespace LSB\LocaleBundle\Entity;

use Doctrine\ORM\Mapping\MappedSuperclass;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use LSB\UtilityBundle\Traits\CreatedUpdatedTrait;
use LSB\UtilityBundle\Traits\UuidTrait;
use LSB\UtilityBundle\Translatable\TranslatableTrait;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Class Language
 * @package LSB\LocaleBundle\Entity
 * @UniqueEntity("isoCode")
 * @MappedSuperclass
 */
class Language implements LanguageInterface, TranslatableInterface
{
    use UuidTrait;
    use TranslatableTrait;
    use CreatedUpdatedTrait;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=5, unique=true)
     * @Assert\Length(max="5")
     */
    protected string $isoCode;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", options={"default" = true})
     */
    protected bool $isEnabled = true;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", options={"default": false})
     */
    protected bool $isDefault = false;

    /**
     * Language constructor.
     */
    public function __construct()
    {
        $this->uuid = $this->generateUuid();
    }

    /**
     *
     */
    public function __clone()
    {
        $this->uuid = $this->generateUuid(true);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }

    /**
     * @return string
     */
    public function getIsoCode(): string
    {
        return $this->isoCode;
    }

    /**
     * @param string $isoCode
     * @return $this
     */
    public function setIsoCode(string $isoCode): self
    {
        $this->isoCode = $isoCode;
        return $this;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->isEnabled;
    }

    /**
     * @param bool $isEnabled
     * @return $this
     */
    public function setIsEnabled(bool $isEnabled): self
    {
        $this->isEnabled = $isEnabled;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDefault(): bool
    {
        return $this->isDefault;
    }

    /**
     * @param bool $isDefault
     * @return $this
     */
    public function setIsDefault(bool $isDefault): self
    {
        $this->isDefault = $isDefault;
        return $this;
    }
}
