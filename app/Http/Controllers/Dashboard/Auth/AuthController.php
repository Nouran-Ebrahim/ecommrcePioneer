<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginAdminRequest;
use App\Providers\RouteServiceProvider;

use App\Services\Auth\AuthService;
use Illuminate\Http\Request;
use Session;

class AuthController extends Controller
{
    private $authService;
    public function __construct(AuthService $authService)
    {
        $this->middleware(['guest:admin'])->only(['showLoginForm', 'login']);
        $this->middleware(['auth:admin'])->only(['logout']);
        $this->authService = $authService;
    }

    public function showLoginForm()
    {
        return view('dashboard.auth.login');
    }
    public function login(LoginAdminRequest $request)
    {

        $credenstials = $request->only(['email', 'password']);
        if ($this->authService->login($credenstials, 'admin', $request->remmber)) {
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

        } else {
            Session::flash('error', trans('auth.failed'));
            //or return redirect()->back()->withErrors(['email'=>trans('auth.failed')])
            return redirect()->back();
        }

    }
    public function logout()
    {
        $this->authService->logout('admin');
        Session::flash('success', trans('messages.successfully_loggedout'));
        return redirect()->route('dashboard.login.showLoginForm');

    }
}
