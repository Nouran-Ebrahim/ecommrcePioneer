<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Session;
use Illuminate\Http\JsonResponse;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
    public function showLoginForm()
    {
        return view('website.auth.login');
    }
    protected function authenticated(Request $request, $user)
    {
        Session::flash('success', 'logged successfuly');
        return redirect()->route('website.profile');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();


        if ($response = $this->loggedOut($request)) {
            return $response;
        }
        Session::flash('success', 'loggedOut successfuly');

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }
}
