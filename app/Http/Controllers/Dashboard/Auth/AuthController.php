<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAdminRequest;
use App\Providers\RouteServiceProvider;

use Illuminate\Http\Request;
use Session;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest:admin'])->only(['showLoginForm', 'login']);
        $this->middleware(['auth:admin'])->only(['logout']);

    }

    public function showLoginForm()
    {
        return view('dashboard.auth.login');
    }
    public function login(CreateAdminRequest $request)
    {


        if (auth()->guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remmber)) {
            if (auth('admin')->user()->status == 0) {
                Session::flash('error', trans('auth.The user not active'));
                auth()->guard('admin')->logout();
                return redirect()->back();
            }
            // $permessions = auth('admin')->user()->role->permessions;
            // $firstPermssssion = $permessions[0];
            Session::flash('success', trans('messages.successfully_logged'));

            // if (!in_array('home', $permessions)) {
            //     return redirect()->intended('admin/' . $firstPermssssion);

            // }
            return redirect()->intended(RouteServiceProvider::ADMIN);

        }
        Session::flash('error', trans('auth.failed'));
        //or return redirect()->back()->withErrors(['email'=>trans('auth.failed')])
        return redirect()->back();
    }
    public function logout()
    {
        auth()->guard('admin')->logout();
        Session::flash('success', trans('messages.successfully_loggedout'));
        return redirect()->route('dashboard.login.showLoginForm');

    }
}
