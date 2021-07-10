<?php

namespace App\Entity;

use App\Repository\ProductSupplyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductSupplyRepository::class)
 */
class ProductSupply
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private ?string $order_number;

    /**
     * @ORM\Column(type="datetime")
     */
    private ?\DateTimeInterface $date;

    /**
     * @ORM\Column(type="boolean")
     */
    private ?bool $isActive;

    /**
     * @ORM\Column(type="boolean")
     */
    private ?bool $status;

    /**
     * @ORM\OneToMany(targetEntity=ProductSupplyList::class, mappedBy="product_supply")
     */
    private $productSupplyLists;

    public function __construct()
    {
        $this->productSupplyLists = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderNumber(): ?string
    {
        return $this->order_number;
    }

    public function setOrderNumber(string $order_number): self
    {
        $this->order_number = $order_number;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection|ProductSupplyList[]
     */
    public function getProductSupplyLists(): Collection
    {
        return $this->productSupplyLists;
    }

    public function addProductSupplyList(ProductSupplyList $productSupplyList): self
    {
        if (!$this->productSupplyLists->contains($productSupplyList)) {
            $this->productSupplyLists[] = $productSupplyList;
            $productSupplyList->setProductSupply($this);
        }

        return $this;
    }

    public function removeProductSupplyList(ProductSupplyList $productSupplyList): self
    {
        if ($this->productSupplyLists->removeElement($productSupplyList)) {
            // set the owning side to null (unless already changed)
            if ($productSupplyList->getProductSupply() === $this) {
                $productSupplyList->setProductSupply(null);
            }
        }

        return $this;
    }
}
