<?php

namespace App\Repositories\Website;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Slider;

class HomeRepository
{
    public function getSliders()
    {
        return Slider::all();
    }
    public function getCategories($limit = null)
    {
        $categories = Category::active()->when($limit ?? null, function ($query) use ($limit) {
            $query->limit($limit);
        })->latest()->get();

        return $categories;
    }
    public function getBrands($limit = null)
    {
        $Brands = Brand::active()->when($limit ?? null, function ($query) use ($limit) {
            $query->limit($limit);
        })->latest()->get();

        return $Brands;
    }
}
