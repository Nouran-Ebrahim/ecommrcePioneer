<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\FaqRequest;
use App\Services\Dashboard\FaqQuestionService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Session;

class FaqQuestionController extends Controller
{
    protected $FaqQuestionService;
    public function __construct(FaqQuestionService $FaqQuestionService)
    {
        $this->FaqQuestionService = $FaqQuestionService;
    }
    public function index()
    {
        $faqs = $this->FaqQuestionService->getFaqs();
        // dd($faqs);
        return view('dashboard.faq-question.index', compact('faqs'));
    }
    public function getAll()
    {
        return $this->FaqQuestionService->getFaqQuestionForDatatables();
    }

    public function destroy(string $id)
    {
        if (!$this->FaqQuestionService->deleteFaq($id)) {
            Session::flash('erorr', __('messages.general_error'));
            return redirect()->back();
        }
        Session::flash('success', __('messages.deleted_successfully'));
        return redirect()->back();

    }
}
