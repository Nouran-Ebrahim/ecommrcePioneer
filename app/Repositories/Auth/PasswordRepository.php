<?php

namespace App\Repositories\Auth;

use App\Models\Admin;
use Ichtrojan\Otp\Otp;

class PasswordRepository
{

    public function findByEmail($email)
    {
        $admin = Admin::where('email', $email)->first();

        return $admin;
    }
    public function verifyOtp($email, $token)
    {
        $otp = (new Otp)->validate($email, $token);

        return $otp;
    }
    public function rest($email, $password)
    {
        $admin = $this->findByEmail($email);

        $admin = $admin->update([
            'password' => bcrypt($password)
        ]);
        return $admin;

    }
}
