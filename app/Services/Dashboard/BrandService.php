<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\BrandRepository;

class BrandService
{
    protected $brandRepository;
    public function __construct(BrandRepository $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }
}
