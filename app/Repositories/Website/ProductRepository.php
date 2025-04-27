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



}
