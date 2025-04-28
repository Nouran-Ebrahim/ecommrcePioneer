<?php

namespace App\Services\Website;

use App\Repositories\Website\HomeRepository;
use App\Repositories\Website\ProductRepository;

class HomeService
{
    protected $homeRepository;
    public $productRepository;

    public function __construct(HomeRepository $homeRepository, ProductRepository $productRepository)
    {
        $this->homeRepository = $homeRepository;
        $this->productRepository = $productRepository;
    }
    public function getSliders()
    {
        return $this->homeRepository->getSliders();
    }
    public function getCategories($limit = null)
    {
        return $this->homeRepository->getCategories($limit);
    }
    public function getBrands($limit = null)
    {
        return $this->homeRepository->getBrands($limit);
    }
    public function getProductsByBrand($slug)
    {
        return $this->homeRepository->getProductsByBrand($slug);
    }
    public function getProductsByCategory($slug)
    {
        return $this->homeRepository->getProductsByCategory($slug);
    }
    public function newAriavalsProducts($limit = null)
    {
        return $this->productRepository->newAriavalsProducts($limit);

    }
    public function getFlashProudcts($limit = null)
    {
        return $this->productRepository->getFlashProudcts($limit);

    }
    public function getFlashProudctsWithTimer($limit = null)
    {
        return $this->productRepository->getFlashProudctsWithTimer($limit);

    }
}
