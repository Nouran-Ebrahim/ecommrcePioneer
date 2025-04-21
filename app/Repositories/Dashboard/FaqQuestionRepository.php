<?php

namespace App\Repositories\Dashboard;
use App\Models\Faq;
use App\Models\FaqQuestion;

class FaqQuestionRepository
{

    public function getFaq($id)
    {
        return FaqQuestion::find($id);
    }
    public function getFaqs()
    {
        // or latest
        return FaqQuestion::latest()->get();
    }

    public function deleteFaq($faq)
    {
        return $faq->delete();
    }
}
