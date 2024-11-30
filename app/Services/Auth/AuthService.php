<?php

namespace App\Services\Auth;

use App\Repositories\Auth\AuthRepository;
use Request;

class AuthService
{
    protected $authRepository;

    public function __construct()
    {
        $this->authRepository = new AuthRepository();

    }
    public function login($credenstials,$gaurd,$remmber)
    {
       return $this->authRepository->login($credenstials,$gaurd,$remmber);
    }
    public function logout($gaurd)
    {
        $this->authRepository->logout($gaurd);
    }
}
