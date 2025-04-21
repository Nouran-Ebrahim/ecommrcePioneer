<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Slider;
use App\Services\Website\FaqService;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public $FaqService;
    public function __construct(FaqService $FaqService)
    {
        $this->FaqService = $FaqService;
    }
    public function index()
    {
        $Faqs = $this->FaqService->getFaqs();

        return view('website.faq', compact('Faqs'));

    }
}
