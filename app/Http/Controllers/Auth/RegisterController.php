<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Session;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }
    public function showRegistrationForm()
    {
        return view('website.auth.register');
    }
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        if (!$this->checkTerms($request->terms)) {
            return redirect()->back()->withErrors(['please accept terms and conditions']); // will reterun the error with key errors as we use with errors
        }
        event(new Registered($user = $this->create($request->all())));
        $user->cart()->create();
        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath());
    }
    public function checkTerms($terms)
    {
        if ($terms == 'on' || $terms == 1) {
            return true;
        } else {
            return false;
        }

    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:30',
            'country_id' => 'required|exists:countries,id',
            'government_id' => 'required|exists:governments,id',
            'city_id' => 'required|exists:cities,id',
            'terms' => ['in:on,off'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'country_id' => $data['country_id'],
            'government_id' => $data['government_id'],
            'city_id' => $data['city_id'],
        ]);
    }
    protected function registered(Request $request, $user)
    {
        Session::flash('success', 'your asccount created successfully');
        return redirect()->route('website.profile');
    }

}
