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
    public function newAriavalsProducts($limit = null)
    {
        return $this->ProductRepository->newAriavalsProducts($limit);

    }
    public function getFlashProudcts($limit = null)
    {
        return $this->ProductRepository->getFlashProudcts($limit);

    }
    public function getFlashProudctsWithTimer($limit = null)
    {
        return $this->ProductRepository->getFlashProudctsWithTimer($limit);

    }



}
