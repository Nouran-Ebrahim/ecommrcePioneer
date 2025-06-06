<?php

namespace App\Services\Website;

use App\Repositories\Website\FaqRepository;

class FaqService
{
    protected $FaqRepository;
    public function __construct(FaqRepository $FaqRepository)
    {
        $this->FaqRepository = $FaqRepository;
    }
    public function getFaqs()
    {
        return $this->FaqRepository->getFaqs();
    }
    public function createFaqQuestion($data)
    {
        return $this->FaqRepository->createFaqQuestion($data);
    }


}
