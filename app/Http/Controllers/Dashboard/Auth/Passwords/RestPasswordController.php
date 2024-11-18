<?php

namespace App\Http\Controllers\Dashboard\Auth\Passwords;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Session;

class RestPasswordController extends Controller
{
    public function showRestForm($email)
    {
        // dd($email);
        return view('dashboard.auth.passwords.rest', compact("email"));
    }
    public function rest(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required'
        ]);
        $admin = Admin::where('email', $request->email)->first();


        if (!$admin) {
            Session::flash('error', 'try again later');
            return redirect()->back();
        }
        $admin->update([
            'password' => bcrypt($request->password)
        ]);
        Session::flash('success', trans('messages.updateed_successfully'));
        return redirect()->route('dashboard.login.showLoginForm');
    }
}
