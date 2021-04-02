<?php
declare(strict_types=1);

namespace LSB\LocaleBundle\Entity;

use Doctrine\ORM\Mapping\MappedSuperclass;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use LSB\UtilityBundle\Traits\CreatedUpdatedTrait;
use LSB\UtilityBundle\Traits\UuidTrait;
use LSB\UtilityBundle\Translatable\TranslatableTrait;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Class Entity
 * @package LSB\LocaleBundle\Entity
 *
 * @UniqueEntity("name")
 * @MappedSuperclass
 */
class Country implements TranslatableInterface, CountryInterface
{
    use UuidTrait;
    use TranslatableTrait;
    use CreatedUpdatedTrait;

    /**
     * @ORM\Column(type="string", length=5)
     * @Assert\Length(max="5")
     */
    protected $isoCode;

    /**
     * @var LanguageInterface|null
     *
     * @ORM\ManyToOne(targetEntity="LSB\LocaleBundle\Entity\LanguageInterface")
     */
    protected ?LanguageInterface $defaultLanguage;

    /**
     * Domyślna waluta
     *
     * @var CurrencyInterface|null
     *
     * @ORM\ManyToOne(targetEntity="LSB\LocaleBundle\Entity\CurrencyInterface", inversedBy="languages")
     */
    protected CurrencyInterface $defaultCurrency;

    /**
     * @var boolean
     * @ORM\Column(type="boolean", options={"default": false})
     */
    protected bool $isUeMember = false;

    /**
     * @var boolean
     * @ORM\Column(type="boolean", options={"default": false})
     */
    protected bool $isDefault = false;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->generateUuid();
    }

    /**
     * @throws \Exception
     */
    public function __clone()
    {
        $this->generateUuid(true);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }

    /**
     * @return mixed
     */
    public function getIsoCode()
    {
        return $this->isoCode;
    }

    /**
     * @param mixed $isoCode
     * @return $this
     */
    public function setIsoCode($isoCode)
    {
        $this->isoCode = $isoCode;
        return $this;
    }

    /**
     * @return LanguageInterface|null
     */
    public function getDefaultLanguage(): ?LanguageInterface
    {
        return $this->defaultLanguage;
    }

    /**
     * @param LanguageInterface|null $defaultLanguage
     * @return $this
     */
    public function setDefaultLanguage(?LanguageInterface $defaultLanguage): self
    {
        $this->defaultLanguage = $defaultLanguage;
        return $this;
    }

    /**
     * @return CurrencyInterface|null
     */
    public function getDefaultCurrency(): ?CurrencyInterface
    {
        return $this->defaultCurrency;
    }

    /**
     * @param CurrencyInterface|null $defaultCurrency
     * @return $this
     */
    public function setDefaultCurrency(?CurrencyInterface $defaultCurrency): self
    {
        $this->defaultCurrency = $defaultCurrency;
        return $this;
    }

    /**
     * @return bool
     */
    public function isUeMember(): bool
    {
        return $this->isUeMember;
    }

    /**
     * @param bool $isUeMember
     * @return $this
     */
    public function setIsUeMember(bool $isUeMember): self
    {
        $this->isUeMember = $isUeMember;
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
