<?php

namespace App\Repositories\Website;
use App\Models\FaqQuestion;
use App\Models\Faq;
use App\Models\Product;
use App\Models\Slider;

class ProductRepository
{
    public function getProductBySlug($slug)
    {
        return Product::active()
            ->with(['images', 'brand', 'category'])
            ->where('slug', $slug)
            ->first();
    }
    public function newAriavalsProducts($limit = null)
    {
        $products = Product::
            with(['category', 'brand', 'images'])
            ->active()
            ->latest()
            ->select(['id', 'name', 'slug', 'price', 'has_variants', 'has_discount', 'discount', 'brand_id', 'category_id'])
            ->paginate($limit);
        return $products;
    }
    public function getFlashProudcts($limit = null)
    {
        $products = Product::where('has_discount', 1)->
            with(['category', 'brand', 'images'])
            ->active()
            ->latest()
            ->select(['id', 'name', 'slug', 'price', 'has_variants', 'has_discount', 'discount', 'brand_id', 'category_id'])
            ->paginate($limit);
        return $products;
    }
    public function getFlashProudctsWithTimer($limit = null)
    {
        $products = Product::
            with(['category', 'brand', 'images'])
            ->active()
            ->where('available_for', date('Y-m-d'))
            ->whereNotNull('available_for')
            ->where('has_discount', 1)
            ->latest()
            ->select(['id', 'name', 'slug', 'price', 'has_variants', 'has_discount', 'discount', 'brand_id', 'category_id'])
            ->paginate($limit);

        return $products;
    }



}
