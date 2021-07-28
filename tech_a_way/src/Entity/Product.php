<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $name;

    /**
     * @ORM\Column(type="float")
     */
    private $exclTaxesPrice;

    /**
     * @ORM\Column(type="smallint")
     */
    private $salesTax;

    /**
     * @ORM\Column(type="float")
     */
    private $inclTaxesPrice;

    /**
     * @ORM\Column(type="integer")
     */
    private $reference;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $stock;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $statusRecent;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $statusPromotion;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $percentagePromotion;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=Brand::class, inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $brand;

    /**
     * @ORM\ManyToMany(targetEntity=Category::class, inversedBy="products")
     * 
     */
    private $categories;

    /**
     * @ORM\OneToMany(targetEntity=Picture::class, mappedBy="product", orphanRemoval=true)
     */
    private $pictures;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->pictures = new ArrayCollection();
        $this->createdAt = new DateTime();
        $this->updatedAt = new DateTime();
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

    public function getExclTaxesPrice(): ?float
    {
        return $this->exclTaxesPrice;
    }

    public function setExclTaxesPrice(float $exclTaxesPrice): self
    {
        $this->exclTaxesPrice = $exclTaxesPrice;

        return $this;
    }

    public function getSalesTax(): ?int
    {
        return $this->salesTax;
    }

    public function setSalesTax(int $salesTax): self
    {
        $this->salesTax = $salesTax;

        return $this;
    }

    public function getInclTaxesPrice(): ?float
    {
        return $this->inclTaxesPrice;
    }

    public function setInclTaxesPrice(float $inclTaxesPrice): self
    {
        $this->inclTaxesPrice = $inclTaxesPrice;

        return $this;
    }

    public function getReference(): ?int
    {
        return $this->reference;
    }

    public function setReference(int $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getStatusRecent(): ?int
    {
        return $this->statusRecent;
    }

    public function setStatusRecent(?int $statusRecent): self
    {
        $this->statusRecent = $statusRecent;

        return $this;
    }

    public function getStatusPromotion(): ?int
    {
        return $this->statusPromotion;
    }

    public function setStatusPromotion(?int $statusPromotion): self
    {
        $this->statusPromotion = $statusPromotion;

        return $this;
    }

    public function getPercentagePromotion(): ?int
    {
        return $this->percentagePromotion;
    }

    public function setPercentagePromotion(?int $percentagePromotion): self
    {
        $this->percentagePromotion = $percentagePromotion;

        return $this;
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

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        $this->categories->removeElement($category);

        return $this;
    }

    /**
     * @return Collection|Picture[]
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function addPicture(Picture $picture): self
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures[] = $picture;
            $picture->setProduct($this);
        }

        return $this;
    }

    public function removePicture(Picture $picture): self
    {
        if ($this->pictures->removeElement($picture)) {
            // set the owning side to null (unless already changed)
            if ($picture->getProduct() === $this) {
                $picture->setProduct(null);
            }
        }

        return $this;
    }
}
