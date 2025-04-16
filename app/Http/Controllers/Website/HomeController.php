<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Slider;
use App\Services\Website\HomeService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public $homeService;
    public function __construct(HomeService $homeService)
    {
        $this->homeService = $homeService;
    }
    public function index()
    {
        $sliders = $this->homeService->getSliders();
        $someCategories=$this->homeService->getCategories(12);

        return view('website.index', compact('sliders','someCategories'));

    }
}
