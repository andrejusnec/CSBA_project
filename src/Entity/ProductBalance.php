<?php

namespace App\Entity;

use App\Repository\ProductBalanceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductBalanceRepository::class)
 */
class ProductBalance
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=ProductSupply::class)
     * @ORM\JoinColumn(nullable=true)
     */
    private ?ProductSupply $product_supply;

    /**
     * @ORM\ManyToOne(targetEntity=ProductsAndServices::class, inversedBy="productBalances")
     */
    private ?ProductsAndServices $product;

    /**
     * @ORM\ManyToOne(targetEntity=Order::class)
     * @ORM\JoinColumn(nullable=true)
     */
    private ?Order $order_id;


    /**
     * @ORM\Column(type="decimal", precision=18, scale=3)
     */
    private $quantity;

    /**
     * @ORM\Column(type="decimal", precision=18, scale=3)
     */
    private $reserved;

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

    public function getOrderId(): ?Order
    {
        return $this->order_id;
    }

    public function setOrderId(?Order $order_id): self
    {
        $this->order_id = $order_id;

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

    public function getReserved(): ?string
    {
        return $this->reserved;
    }

    public function setReserved(string $reserved): self
    {
        $this->reserved = $reserved;

        return $this;
    }
}
