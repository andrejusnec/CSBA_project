<?php

namespace App\Entity;

use App\Repository\ProductSupplyListRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductSupplyListRepository::class)
 */
class ProductSupplyList
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=ProductSupply::class, inversedBy="productSupplyLists")
     * @ORM\JoinColumn(nullable=true)
     */
    private $product_supply;

    /**
     * @ORM\ManyToOne(targetEntity=ProductsAndServices::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;

    /**
     * @ORM\Column(type="decimal", precision=18, scale=3)
     */
    private $quantity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductSupply(): ?ProductSupply
    {
        return $this->product_supply;
    }

    public function setProductSupply(?ProductSupply $product_supply): self
    {
        $this->product_supply = $product_supply;

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


    public function getQuantity(): ?string
    {
        return $this->quantity;
    }

    public function setQuantity(string $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }
}
