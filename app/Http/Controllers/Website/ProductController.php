<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Slider;
use App\Services\Website\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public $ProductService;
    public function __construct(ProductService $ProductService)
    {
        $this->ProductService = $ProductService;
    }
    public function show($slug)
    {

        $product = $this->ProductService->getProductBySlug($slug);
        if (!$product) {
            abort(404);
        }
        return view('website.show', compact('product'));

    }

}
