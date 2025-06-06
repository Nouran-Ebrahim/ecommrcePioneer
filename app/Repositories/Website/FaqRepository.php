<?php

namespace App\Repositories\Website;
use App\Models\FaqQuestion;
use App\Models\Faq;
use App\Models\Slider;

class FaqRepository
{
    public function getFaqs()
    {
        return Faq::all();
    }
    public function createFaqQuestion($data)
    {
        // dd($data);
        return FaqQuestion::create($data);
    }


}
