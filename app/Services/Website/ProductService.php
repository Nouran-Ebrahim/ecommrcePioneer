<?php

namespace App\Services\Website;

use App\Repositories\Website\ProductRepository;

class ProductService
{
    protected $ProductRepository;
    public function __construct(ProductRepository $ProductRepository)
    {
        $this->ProductRepository = $ProductRepository;
    }
    public function getProductBySlug($slug)
    {
        return $this->ProductRepository->getProductBySlug($slug);
    }



}
