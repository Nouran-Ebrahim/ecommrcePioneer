<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\FaqRepository;

class FaqService
{
    /**
     * Create a new class instance.
     */
    protected $faqRepository;
    public function __construct(FaqRepository $faqRepository)
    {
        $this->faqRepository = $faqRepository;
    }

    public function getFaq($id)
    {
        $faq = $this->faqRepository->getFaq($id);
        return $faq ?? abort(404); // Return 404 if FAQ not found
    }
    public function getFaqs()
    {
        return $this->faqRepository->getFaqs();
    }
    public function storeFaq($data)
    {
        return $this->faqRepository->storeFaq($data);
    }
    public function updateFaq($data, $id)
    {
        $faq = $this->getFaq($id);
        return $this->faqRepository->updateFaq($data, $faq);
    }
    public function deleteFaq($id)
    {
        $faq = $this->getFaq($id);
        return $this->faqRepository->deleteFaq($faq);
    }
}
