<?php
declare(strict_types=1);

namespace LSB\LocaleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\MappedSuperclass;
use Knp\DoctrineBehaviors\Contract\Entity\TranslationInterface;
use Knp\DoctrineBehaviors\Model\Translatable\TranslationTrait;
use LSB\UtilityBundle\Traits\IdTrait;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class LanguageTranslation
 * @package LSB\LocaleBundle\Entity
 * @MappedSuperclass
 */
class LanguageTranslation implements LanguageTranslationInterface, TranslationInterface
{
    use IdTrait;
    use TranslationTrait;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255, groups={"Default"})
     */
    protected ?string $name = null;

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return $this
     */
    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }
}
