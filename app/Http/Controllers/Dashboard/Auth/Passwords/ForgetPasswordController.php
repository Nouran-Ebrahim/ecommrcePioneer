<?php

namespace App\Http\Controllers\Dashboard\Auth\Passwords;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Notifications\SendOtpNotify;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Exceptions\Exception;
use Ichtrojan\Otp\Otp;

class ForgetPasswordController extends Controller
{
    public function showEmailForm()
    {
        return view('dashboard.auth.passwords.email');
    }
    public function sendOtp(Request $request)
    {

        $request->validate([
            'email' => 'required|email'
        ]);
        $admin = Admin::where('email', $request->email)->first();
        if (!$admin) {
            return redirect()->back()->withErrors(['email' => trans('messages.try agian later')]);
        }
        $admin->notify(new SendOtpNotify());
        return redirect()->route('dashboard.password.showConfirmForm', ['email' => $admin->email]);

    }
    public function showConfirmForm($email)
    {
        return view('dashboard.auth.passwords.confirm', compact('email'));
    }

    public function verifyOtp(Request $request)
    {

        $request->validate([
            'token' => 'required|min:5',
            'email' => 'required|email'
        ]);
        $otp = (new Otp)->validate($request->email, $request->token);
        if ($otp->status == false) {
            return redirect()->back()->withErrors(['token' => trans('messages.OTP does not exist') ]);

        }
        return redirect()->route('dashboard.password.showRestForm', ['email' => $request->email]);

    }
}
