<?php
declare(strict_types=1);

namespace LSB\LocaleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\MappedSuperclass;
use LSB\UtilityBundle\Traits\CreatedUpdatedTrait;
use LSB\UtilityBundle\Traits\UuidTrait;

/**
 * Class Currency
 * @package LSB\LocaleBundle\Entity
 * @MappedSuperclass
 */
class Currency implements CurrencyInterface
{
    use UuidTrait;
    use CreatedUpdatedTrait;

    /**
     * @var string
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    protected string $name;

    /**
     * @var string
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    protected string $isoCode;

    /**
     * @var integer
     * @ORM\Column(type="integer", nullable=true)
     */
    protected int $position;

    /**
     * @var bool
     * @ORM\Column(type="boolean", nullable=false, options={"default" : false})
     */
    protected bool $isDefault = false;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->uuid = $this->generateUuid();
    }

    /**
     * @throws \Exception
     */
    public function __clone()
    {
        $this->uuid = $this->generateUuid(true);
        $this->id = null;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Currency
     */
    public function setName(string $name): Currency
    {
        $this->name = $name;
        return $this;
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
     * @return Currency
     */
    public function setIsoCode(string $isoCode): Currency
    {
        $this->isoCode = $isoCode;
        return $this;
    }

    /**
     * @return int
     */
    public function getPosition(): int
    {
        return $this->position;
    }

    /**
     * @param int $position
     * @return Currency
     */
    public function setPosition(int $position): Currency
    {
        $this->position = $position;
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
     * @return Currency
     */
    public function setIsDefault(bool $isDefault): Currency
    {
        $this->isDefault = $isDefault;
        return $this;
    }
}
