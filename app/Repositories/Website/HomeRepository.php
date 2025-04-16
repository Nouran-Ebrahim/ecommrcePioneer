<?php

namespace App\Repositories\Website;
use App\Models\Category;
use App\Models\Slider;

class HomeRepository
{
    public function getSliders()
    {
        return Slider::all();
    }
    public function getCategories($take = null)
    {
        return Category::active()->latest()->get()->take($take);
    }
}
