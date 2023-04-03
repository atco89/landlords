<?php

namespace App\Service;

use App\Repository\CategoryRepository;

class CategoryService
{

    public function __construct(
        private readonly CategoryRepository $categoryRepository,
    )
    {
    }
}