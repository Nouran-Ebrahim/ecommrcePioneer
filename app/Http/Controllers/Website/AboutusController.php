<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Slider;
use Illuminate\Http\Request;

class AboutusController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return view('website.aboutus', compact('sliders'));

    }
}
