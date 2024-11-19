<?php

namespace App\Repositories\Auth;

use Request;

class AuthRepository
{


    public function login($credenstials, $gaurd, $remmber=false)
    {
        return auth()->guard($gaurd)->attempt($credenstials, $remmber);
    }
    public function logout($gaurd)
    {
        return auth()->guard($gaurd)->logout();
    }
}
