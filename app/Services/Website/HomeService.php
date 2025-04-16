<?php

namespace App\Services\Website;

use App\Repositories\Website\HomeRepository;

class HomeService
{
    protected $homeRepository;
    public function __construct(HomeRepository $homeRepository)
    {
        $this->homeRepository = $homeRepository;
    }
    public function getSliders()
    {
      return  $this->homeRepository->getSliders();
    }
    public function getCategories($take = null)
    {
        return $this->homeRepository->getCategories($take);
    }
}
