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
    public function getProductsByBrand($slug)
    {
        $brand = Brand::where('slug', $slug)->first();
        $products = $brand->products()
            ->active()
            ->with(['category', 'brand', 'images'])
            ->latest()
            ->select(['id', 'name', 'slug', 'price', 'has_variants', 'has_discount', 'discount', 'brand_id', 'category_id'])
            ->paginate(2);
        return $products;
    }
    public function getProductsByCategory($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $products = $category->products()
            ->active()
            ->with(['category', 'brand', 'images'])
            ->latest()->select(['id', 'name', 'slug', 'price', 'has_variants', 'has_discount', 'discount', 'brand_id', 'category_id'])
            ->paginate(2);
        return $products;
    }
}
