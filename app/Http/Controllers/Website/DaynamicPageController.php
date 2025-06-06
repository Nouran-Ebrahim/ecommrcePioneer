<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Slider;
use App\Services\Dashboard\PageService;
use Illuminate\Http\Request;

class DaynamicPageController
{
    public $pageService;
    public function __construct(PageService $pageService)
    {
        $this->pageService = $pageService;
    }
    public function index($slug)
    {

        $page = $this->pageService->getBySlug($slug);
        if (!$page) {
            abort(404);
        }
        return view('website.daynamic-page', compact("page"));

    }
}
