<?php

namespace App\Entity;

use App\Repository\ProductsAndServicesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductsAndServicesRepository::class)
 */
class ProductsAndServices
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private ?bool $isProduct;

    /**
     * @ORM\OneToMany(targetEntity=Image::class, mappedBy="product_id")
     */
    private ArrayCollection $images;

    /**
     * @ORM\ManyToOne(targetEntity=Measure::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Measure $measure_code;

    /**
     * @ORM\Column(type="boolean")
     */
    private ?bool $isActive;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $title;

    /**
     * @ORM\OneToMany(targetEntity=ProductOrderList::class, mappedBy="product")
     */
    private $productOrderLists;

    /**
     * @ORM\OneToMany(targetEntity=ProductBalance::class, mappedBy="product")
     */
    private $productBalances;

    /**
     * ProductsAndServices constructor.
     */
    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->productOrderLists = new ArrayCollection();
        $this->productBalances = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsProduct(): ?bool
    {
        return $this->isProduct;
    }

    public function setIsProduct(bool $isProduct): self
    {
        $this->isProduct = $isProduct;

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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setProductId($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getProductId() === $this) {
                $image->setProductId(null);
            }
        }

        return $this;
    }

    public function getMeasureCode(): ?Measure
    {
        return $this->measure_code;
    }

    public function setMeasureCode(?Measure $measure_code): self
    {
        $this->measure_code = $measure_code;

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
            $productOrderList->setProduct($this);
        }

        return $this;
    }

    public function removeProductOrderList(ProductOrderList $productOrderList): self
    {
        if ($this->productOrderLists->removeElement($productOrderList)) {
            // set the owning side to null (unless already changed)
            if ($productOrderList->getProduct() === $this) {
                $productOrderList->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ProductBalance[]
     */
    public function getProductBalances(): Collection
    {
        return $this->productBalances;
    }

    public function addProductBalance(ProductBalance $productBalance): self
    {
        if (!$this->productBalances->contains($productBalance)) {
            $this->productBalances[] = $productBalance;
            $productBalance->setProduct($this);
        }

        return $this;
    }

    public function removeProductBalance(ProductBalance $productBalance): self
    {
        if ($this->productBalances->removeElement($productBalance)) {
            // set the owning side to null (unless already changed)
            if ($productBalance->getProduct() === $this) {
                $productBalance->setProduct(null);
            }
        }

        return $this;
    }
}
