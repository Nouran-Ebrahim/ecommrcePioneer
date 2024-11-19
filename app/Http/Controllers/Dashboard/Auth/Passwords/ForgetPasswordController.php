<?php

namespace App\Http\Controllers\Dashboard\Auth\Passwords;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgetPasswordRequest;
use App\Models\Admin;
use App\Notifications\SendOtpNotify;
use App\Services\Auth\PasswordService;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Exceptions\Exception;
use Ichtrojan\Otp\Otp;

class ForgetPasswordController extends Controller
{
    private $passwordService;
    public function __construct(PasswordService $passwordService)
    {
        $this->passwordService = $passwordService;
    }
    public function showEmailForm()
    {
        return view('dashboard.auth.passwords.email');
    }
    public function sendOtp(ForgetPasswordRequest $request)
    {
        $admin = $this->passwordService->sendOtp($request->email);
        if (!$admin) {
            return redirect()->back()->withErrors(['email' => trans('messages.try agian later')]);
        }
        return redirect()->route('dashboard.password.showConfirmForm', ['email' => $admin->email]);
    }
    public function showConfirmForm($email)
    {
        return view('dashboard.auth.passwords.confirm', compact('email'));
    }

    public function verifyOtp(ForgetPasswordRequest $request)
    {
        $status = $this->passwordService->verifyOtp($request->email, $request->token);

        if ($status == false) {
            return redirect()->back()->withErrors(['error' => trans('messages.OTP does not exist')]);

        }
        return redirect()->route('dashboard.password.showRestForm', ['email' => $request->email]);

    }
}
