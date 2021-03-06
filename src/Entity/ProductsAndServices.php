<?php

namespace App\Entity;

use App\Manager\PriceManager;
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
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private ?bool $isProduct;

    /**
     * @ORM\OneToMany(targetEntity=Image::class, mappedBy="product")
     */
    private $images;

    /**
     * @ORM\ManyToOne(targetEntity=Measure::class)
     * @ORM\JoinColumn(nullable=true, name="measure_code_id", referencedColumnName="code")
     */
    private $measure_code;

    /**
     * @ORM\Column(type="boolean")
     */
    private ?bool $isActive;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $title;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private ?string $fontawesome_icon;

    /**
     * @ORM\OneToMany(targetEntity=ProductOrderList::class, mappedBy="product")
     */
    private $productOrderLists;

    /**
     * @ORM\OneToMany(targetEntity=ProductBalance::class, mappedBy="product")
     */
    private $productBalances;

    /**
     * @ORM\Column(type="boolean")
     */
    private ?bool $isCatalog;

    /**
     * @ORM\ManyToOne(targetEntity=ProductsAndServices::class)
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    private ?ProductsAndServices $parent;

    /**
     * @ORM\OneToOne(targetEntity=Image::class)
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    private $main_image;

    /**
     * @ORM\OneToMany(targetEntity=Price::class, mappedBy="product")
     */
    private $prices;

    /**
     * @ORM\ManyToMany(targetEntity=Tag::class, inversedBy="productsAndServices", cascade={"persist"})
     */
    private $tags;


    /**
     * ProductsAndServices constructor.
     */
    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->productOrderLists = new ArrayCollection();
        $this->productBalances = new ArrayCollection();
        $this->prices = new ArrayCollection();
        $this->tags = new ArrayCollection();
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

    public function getMainImage()
    {
        return $this->main_image;
    }

    public function setMainImage($main_image): void
    {
        $this->main_image = $main_image;
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

    public function getIsCatalog(): ?bool
    {
        return $this->isCatalog;
    }

    public function setIsCatalog(bool $isCatalog): self
    {
        $this->isCatalog = $isCatalog;

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    public function __toString()
    {
        return $this->title;
    }

    public function getfontawesome_icon(): ?string
    {
        return $this->fontawesome_icon;
    }

    public function getFontawesomeIcon(): ?string
    {
        return $this->fontawesome_icon;
    }

    public function setFontawesomeIcon(?string $fontawesome_icon): void
    {
        $this->fontawesome_icon = $fontawesome_icon;
    }
//    public function images() : ?Image {
//
//        if($this->images != []) {
//            return $this->images[0]->getFileName();
//        }
//    }

    /**
     * @return Collection|Price[]
     */
    public function getPrices(): Collection
    {
        return $this->prices;
    }

    public function addPrice(Price $price): self
    {
        if (!$this->prices->contains($price)) {
            $this->prices[] = $price;
            $price->setProduct($this);
        }

        return $this;
    }

    public function removePrice(Price $price): self
    {
        if ($this->prices->removeElement($price)) {
            // set the owning side to null (unless already changed)
            if ($price->getProduct() === $this) {
                $price->setProduct(null);
            }
        }

        return $this;
    }

    public function getCurrentPrice(PriceManager $priceManager): int
    {
        return $priceManager->getPriceByPeriod(product_id: $this->getId());
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        $this->tags->removeElement($tag);

        return $this;
    }
}
