<?php

namespace App\Service;

use App\Repository\ProductRepository;

class ProductService
{

    public function __construct(
        private readonly ProductRepository $productRepository,
    )
    {
    }
}