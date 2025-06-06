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
        $someCategories = $this->homeService->getCategories(12);
        $someBrands = $this->homeService->getBrands(12);
        $newAriavals = $this->homeService->newAriavalsProducts(8);
        $flashProudcts = $this->homeService->getFlashProudcts(8);
        $flashProudctsTimer = $this->homeService->getFlashProudctsWithTimer(8);

        return view('website.index', compact('sliders', 'newAriavals', 'flashProudctsTimer', 'flashProudcts', 'someCategories', 'someBrands', 'newAriavals'));

    }
}
