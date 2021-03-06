<?php

namespace App\Entity;

use App\Repository\MeasureRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Id;

/**
 * @ORM\Entity(repositoryClass=MeasureRepository::class)
 */
class Measure
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=3)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private ?string $short_name;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private ?string $full_name;

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getShortName(): ?string
    {
        return $this->short_name;
    }

    public function setShortName(string $short_name): self
    {
        $this->short_name = $short_name;

        return $this;
    }

    public function getFullName(): ?string
    {
        return $this->full_name;
    }

    public function setFullName(string $full_name): self
    {
        $this->full_name = $full_name;

        return $this;
    }

    public function __toString()
    {
        return $this->full_name;
    }
}
