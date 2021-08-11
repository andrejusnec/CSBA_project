<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Vich\UploaderBundle\Entity\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * @ORM\Entity(repositoryClass=ImageRepository::class)
 * @Vich\Uploadable()
 */
class Image
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
    private $file_name;



    /**
     * @ORM\ManyToOne(targetEntity=ProductsAndServices::class, inversedBy="images")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    public ?ProductsAndServices $product;

    /**
     * @ORM\Column(type="boolean")
     */
    private ?bool $isActive;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $title;

    /**
     * @Vich\UploadableField(mapping="thumbnails", fileNameProperty="file_name")
     * @var File
     */
    private $thumbnail;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function __construct()
    {
        $this->createdAt = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getFileName(): ?string
    {
        return $this->file_name;
    }

    public function setFileName(?string $file_name): self
    {
        $this->file_name = $file_name;

        return $this;
    }

    public function getProductId(): ?ProductsAndServices
    {
        return $this->product;
    }

    public function setProductId(?ProductsAndServices $product): self
    {
        $this->product = $product;

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

    /**
     * @return mixed
     */
    public function getThumbnail(): mixed
    {
        return $this->thumbnail;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\File\File|null $thumbnail
     */
    public function setThumbnail(\Symfony\Component\HttpFoundation\File\File $thumbnail = null): void
    {
        $this->thumbnail = $thumbnail;
        if ($thumbnail) {
            $this->createdAt = new DateTime();
        }
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
    public function __toString() {
        return $this->title;
    }

}
