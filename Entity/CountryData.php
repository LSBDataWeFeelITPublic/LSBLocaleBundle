<?php
declare(strict_types=1);

namespace LSB\LocaleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
class CountryData
{
    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected string $isoCode;


}
