<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Slider;
use App\Services\Website\HomeService;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public $homeService;
    public function __construct(HomeService $homeService)
    {
        $this->homeService = $homeService;
    }
    public function index()
    {

        $brands = $this->homeService->getBrands(12);

        return view('website.brands', compact('brands'));

    }
    public function getProductsByBrand($slug)
    {
        $products = $this->homeService->getProductsByBrand($slug);
// dd($products);
        return view('website.products', compact('products'));
    }
}
