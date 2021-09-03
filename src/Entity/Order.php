<?php

namespace App\Entity;

use App\Repository\OrderRepository;
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
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product_id;

    /**
     * @ORM\ManyToOne(targetEntity=RangeDateSale::class, inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $range_date_sales_id;



    /**
     * @ORM\Column(type="date")
     */
    private $sale_date;

    /**
     * @ORM\Column(type="integer")
     */
    private $sale_sum;

    /**
     * @ORM\Column(type="integer")
     */
    private $sale_count;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductId(): ?Product
    {
        return $this->product_id;
    }

    public function setProductId(?Product $product_id): self
    {
        $this->product_id = $product_id;

        return $this;
    }

    public function getRangeDateSalesId(): ?RangeDateSale
    {
        return $this->range_date_sales_id;
    }

    public function setRangeDateSalesId(?RangeDateSale $range_date_sales_id): self
    {
        $this->range_date_sales_id = $range_date_sales_id;

        return $this;
    }

    public function getSaleDate(): ?\DateTimeInterface
    {
        return $this->sale_date;
    }

    public function setSaleDate(\DateTimeInterface $sale_date): self
    {
        $this->sale_date = $sale_date;

        return $this;
    }

    public function getSaleSum(): ?int
    {
        return $this->sale_sum;
    }

    public function setSaleSum(int $sale_sum): self
    {
        $this->sale_sum = $sale_sum;

        return $this;
    }

    public function getSaleCount(): ?int
    {
        return $this->sale_count;
    }

    public function setSaleCount(int $sale_count): self
    {
        $this->sale_count = $sale_count;

        return $this;
    }
}
