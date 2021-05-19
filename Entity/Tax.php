<?php
declare(strict_types=1);

namespace LSB\LocaleBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\MappedSuperclass;
use LSB\UtilityBundle\Traits\CreatedUpdatedTrait;
use LSB\UtilityBundle\Traits\UuidTrait;

/**
 * @MappedSuperclass
 */
class Tax implements TaxInterface
{
    use CreatedUpdatedTrait;
    use UuidTrait;

    /**
     * @var float|null
     * @ORM\Column(type="decimal", precision=18, scale=2, nullable=true)
     */
    protected $value;

    /**
     * @var boolean
     * @ORM\Column(type="boolean", nullable=false, options={"default" : false})
     */
    protected bool $isDefault = false;

    /**
     * @ORM\ManyToOne(targetEntity="LSB\LocaleBundle\Entity\CountryInterface")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected CountryInterface $country;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected ?DateTime $dateFrom;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected ?DateTime $dateTo;

    /**
     * @var bool
     * @ORM\Column(type="boolean", nullable=true, options={"default" : true})
     */
    protected bool $isEnabled = true;

    /**
     * @ORM\Column(type="integer")
     */
    protected int $type = self::TYPE_VAT;

    /**
     * @ORM\Column(type="integer")
     */
    protected int $calculationType;

    /**
     * @return float|null
     */
    public function getValue(): ?float
    {
        return $this->value;
    }

    /**
     * @param float|null $value
     * @return $this
     */
    public function setValue(?float $value): self
    {
        $this->value = $value;
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

    /**
     * @return CountryInterface
     */
    public function getCountry(): CountryInterface
    {
        return $this->country;
    }

    /**
     * @param CountryInterface $country
     * @return $this
     */
    public function setCountry(CountryInterface $country): self
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getDateFrom(): ?DateTime
    {
        return $this->dateFrom;
    }

    /**
     * @param DateTime|null $dateFrom
     * @return $this
     */
    public function setDateFrom(?DateTime $dateFrom): self
    {
        $this->dateFrom = $dateFrom;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getDateTo(): ?DateTime
    {
        return $this->dateTo;
    }

    /**
     * @param DateTime|null $dateTo
     * @return $this
     */
    public function setDateTo(?DateTime $dateTo): self
    {
        $this->dateTo = $dateTo;
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
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @param int $type
     * @return $this
     */
    public function setType(int $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return int
     */
    public function getCalculationType(): int
    {
        return $this->calculationType;
    }

    /**
     * @param int $calculationType
     * @return $this
     */
    public function setCalculationType(int $calculationType): self
    {
        $this->calculationType = $calculationType;
        return $this;
    }
}
