<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=RangeDateSale::class, mappedBy="product_id", orphanRemoval=true)
     */
    private $rangeDateSales;

    /**
     * @ORM\OneToMany(targetEntity=Order::class, mappedBy="product_id")
     */
    private $orders;

    public function __construct()
    {
        $this->sa = new ArrayCollection();
        $this->rangeDateSales = new ArrayCollection();
        $this->orders = new ArrayCollection();
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
     * @return Collection|RangeDateSale[]
     */
    public function getRangeDateSales(): Collection
    {
        return $this->rangeDateSales;
    }

    public function addRangeDateSale(RangeDateSale $rangeDateSale): self
    {
        if (!$this->rangeDateSales->contains($rangeDateSale)) {
            $this->rangeDateSales[] = $rangeDateSale;
            $rangeDateSale->setProductId($this);
        }

        return $this;
    }

    public function removeRangeDateSale(RangeDateSale $rangeDateSale): self
    {
        if ($this->rangeDateSales->removeElement($rangeDateSale)) {
            // set the owning side to null (unless already changed)
            if ($rangeDateSale->getProductId() === $this) {
                $rangeDateSale->setProductId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Order[]
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->setProductId($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getProductId() === $this) {
                $order->setProductId(null);
            }
        }

        return $this;
    }
}
