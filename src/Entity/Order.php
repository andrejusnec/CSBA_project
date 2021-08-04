<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\ManyToOne(targetEntity=Country::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $post_code;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $order_number;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity=ProductOrderList::class, mappedBy="order_id", cascade={"persist", "remove"})
     */
    private $productOrderLists;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="decimal", precision=15, scale=2, nullable=true)
     */
    private $order_total;

    public function __construct()
    {
        $this->productOrderLists = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getPostCode(): ?string
    {
        return $this->post_code;
    }

    public function setPostCode(string $post_code): self
    {
        $this->post_code = $post_code;

        return $this;
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
     * @return Collection|ProductOrderList[]
     */
    public function getProductOrderLists(): Collection
    {
        return $this->productOrderLists;
    }

    public function addProductOrderList(ProductOrderList $productOrderList): self
    {
        if (!$this->productOrderLists->contains($productOrderList)) {
            $this->productOrderLists[] = $productOrderList;
            $productOrderList->setOrderId($this);
        }

        return $this;
    }

    public function removeProductOrderList(ProductOrderList $productOrderList): self
    {
        if ($this->productOrderLists->removeElement($productOrderList)) {
            // set the owning side to null (unless already changed)
            if ($productOrderList->getOrderId() === $this) {
                $productOrderList->setOrderId(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
    public function __toString() {
        return $this->order_number;
    }
    public function uniqOrderNumber() {
        $this->order_number = time() . $this->id . mt_rand(1,100000000);;
    }

    public function getOrderTotal(): ?string
    {
        return $this->order_total;
    }

    public function setOrderTotal(?string $order_total): self
    {
        $this->order_total = $order_total;

        return $this;
    }
}
