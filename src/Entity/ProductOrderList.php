<?php

namespace App\Entity;

use App\Repository\ProductOrderListRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductOrderListRepository::class)
 */
class ProductOrderList
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\ManyToOne(targetEntity=ProductsAndServices::class, inversedBy="productOrderLists")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?ProductsAndServices $product;

    /**
     * @ORM\Column(type="decimal", precision=18, scale=3)
     */
    private $quantity;

    /**
     * @ORM\Column(type="decimal", precision=18, scale=2)
     */
    private $price;

    /**
     * @ORM\Column(type="decimal", precision=18, scale=2)
     */
    private $total;

    /**
     * @ORM\ManyToOne(targetEntity=Order::class, inversedBy="productOrderLists")
     * @ORM\JoinColumn(nullable=false)
     */
    private $order_id;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getTotal(): ?string
    {
        return $this->total;
    }

    public function setTotal(string $total): self
    {
        $this->total = $total;

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
}
