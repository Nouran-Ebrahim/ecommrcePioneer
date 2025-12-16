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
            ->with(['images', 'brand','productPreviews', 'category'])
            ->where('slug', $slug)
            ->first();
    }
    public function getRelatedProductsBySlug($product, $limit = null)
    {
        $products = Product::active()
            ->with(['images','productPreviews', 'brand', 'category'])
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->latest();
        if ($limit) {
            return $products->paginate($limit);
        }
        return $products->paginate(30);
    }
    public function newAriavalsProducts($limit = null)
    {
        $products = Product::query()->
            with(['category', 'brand', 'images'])
            ->active()
            ->latest()
            ->select(['id', 'name', 'slug', 'price', 'has_variants', 'has_discount', 'discount', 'brand_id', 'category_id']);
        if ($limit) {
            return $products->paginate($limit);
        }
        return $products->paginate(2);
    }
    public function getFlashProudcts($limit = null)
    {
        $products = Product::query()->where('has_discount', 1)->
            with(['category', 'brand', 'images'])
            ->active()
            ->latest()
            ->select(['id', 'name', 'slug', 'price', 'has_variants', 'has_discount', 'discount', 'brand_id', 'category_id']);
        if ($limit) {
            return $products->paginate($limit);
        }
        return $products->paginate(30);
    }
    public function getFlashProudctsWithTimer($limit = null)
    {
        $products = Product::query()->
            with(['category', 'brand', 'images'])
            ->active()
            ->where('available_for', date('Y-m-d'))
            ->whereNotNull('available_for')
            ->where('has_discount', 1)
            ->latest()
            ->select(['id', 'name', 'slug', 'price', 'has_variants', 'has_discount', 'discount', 'brand_id', 'category_id']);
        if ($limit) {
            return $products->paginate($limit);
        }
        return $products->paginate(30);
    }




}
