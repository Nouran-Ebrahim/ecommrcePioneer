<?php

namespace App\Repositories\Dashboard;

use App\Models\Slider;

class SliderRepository
{

    public function getSliders()
    {
       $sliders = Slider::latest()->get();
       return $sliders;
    }
    public function getSlider($id)
    {
        $slider = Slider::find($id);
        return $slider;
    }
    public function createSlider($data)
    {
        $slider = Slider::create($data);
        return $slider;
    }
    // public function updateSlider($slider, $data)
    // {
    //    return $slider->update($data);
    // }
    public function deleteSlider($slider)
    {
       return $slider->delete();
    }


}
