<?php

namespace App\Entity;

use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TagRepository::class)
 */
class Tag
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=ProductsAndServices::class, mappedBy="tags")
     */
    private $productsAndServices;

    public function __construct()
    {
        $this->productsAndServices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getProductsAndServices(): Collection
    {
        return $this->productsAndServices;
    }

    public function addProductsAndService(ProductsAndServices $productsAndService): self
    {
        if (!$this->productsAndServices->contains($productsAndService)) {
            $this->productsAndServices[] = $productsAndService;
            $productsAndService->addTag($this);
        }

        return $this;
    }

    public function removeProductsAndService(ProductsAndServices $productsAndService): self
    {
        if ($this->productsAndServices->removeElement($productsAndService)) {
            $productsAndService->removeTag($this);
        }

        return $this;
    }

    public function setProductsAndService(ProductsAndServices $productsAndService): self
    {
        if (!$this->productsAndServices->contains($productsAndService)) {
            $this->productsAndServices[] = $productsAndService;
            $productsAndService->addTag($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
