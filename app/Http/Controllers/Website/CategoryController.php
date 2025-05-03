<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Slider;
use App\Services\Website\HomeService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public $homeService;
    public function __construct(HomeService $homeService)
    {
        $this->homeService = $homeService;
    }
    public function index()
    {
        $categories = $this->homeService->getCategories();

        return view('website.categories', compact('categories'));

    }
    public function getProductsByCategory($slug)
    {
        $products = $this->homeService->getProductsByCategory($slug);
        $type="";
        return view('website.products', compact('products','type'));
    }
}
