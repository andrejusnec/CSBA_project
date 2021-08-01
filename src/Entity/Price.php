<?php

namespace App\Entity;

use App\Repository\PriceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PriceRepository::class)
 */
class Price
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $period;

    /**
     * @ORM\ManyToOne(targetEntity=ProductsAndServices::class, inversedBy="prices")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;

    /**
     * @ORM\Column(type="decimal", precision=15, scale=2)
     */
    private $price;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPeriod(): ?\DateTimeInterface
    {
        return $this->period;
    }

    public function setPeriod(\DateTimeInterface $period): self
    {
        $this->period = $period;

        return $this;
    }

    public function getProduct(): ?ProductsAndServices
    {
        return $this->product;
    }

    public function setProduct(?ProductsAndServices $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }
}
