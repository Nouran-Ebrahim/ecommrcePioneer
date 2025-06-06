<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\FaqQuestionRepository;
use Yajra\DataTables\Facades\DataTables;

class FaqQuestionService
{
    /**
     * Create a new class instance.
     */
    protected $FaqQuestionRepository;
    public function __construct(FaqQuestionRepository $FaqQuestionRepository)
    {
        $this->FaqQuestionRepository = $FaqQuestionRepository;
    }
    public function getFaqQuestionForDatatables()
    {

        $FaqQuestions = $this->getFaqs();
        return DataTables::of($FaqQuestions)
            ->addIndexColumn()
            ->addColumn('message', function ($faqsQuestion) {
                return view('dashboard.faq-question.datatables.message', compact('faqsQuestion'));
            })

            ->addColumn('action', function ($faqsQuestion) {
                return view('dashboard.faq-question.datatables.actions', compact('faqsQuestion'));
            })
            ->rawColumns(['action', 'message']) // for render html content
            ->make(true);
    }
    public function getFaq($id)
    {
        $faq = $this->FaqQuestionRepository->getFaq($id);
        return $faq ?? abort(404); // Return 404 if FAQ not found
    }
    public function getFaqs()
    {
        return $this->FaqQuestionRepository->getFaqs();
    }

    public function deleteFaq($id)
    {
        $faq = $this->getFaq($id);
        return $this->FaqQuestionRepository->deleteFaq($faq);
    }
}
