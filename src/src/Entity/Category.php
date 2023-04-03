<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Table(name: 'categories')]
#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Category extends Base
{

    #[ORM\Column(unique: true)]
    #[Assert\NotBlank]
    #[Assert\Unique]
    private string $name;

    #[ORM\OneToMany(mappedBy: 'id', targetEntity: Product::class)]
    private Collection $products;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function setProducts(Collection $products): self
    {
        $this->products = $products;
        return $this;
    }
}
