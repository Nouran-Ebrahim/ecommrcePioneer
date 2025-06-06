<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
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
        $relatedProducts=$this->ProductService->getRelatedProductsBySlug($product,4);
        // dd($relatedProducts);
        return view('website.show', compact('product','relatedProducts'));

    }
    public function relatedProducts(Product $product)
    {
        $products=$this->ProductService->getRelatedProductsBySlug($product);
        $type="";
        return view('website.products', compact('products','type'));

    }
    public function getProductsByType($type)
    {

        if ($type == "flash") {
            $products = $this->ProductService->getFlashProudcts();
        } elseif ($type == "new_ariavals") {
            $products = $this->ProductService->newAriavalsProducts();

        } elseif ($type == "flash_timer") {
            $products = $this->ProductService->getFlashProudctsWithTimer();
        } else {
            abort(404);
        }
        return view('website.products', compact('products','type'));

    }

}
