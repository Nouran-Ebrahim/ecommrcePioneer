<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use ApiResponse;
    public function login(UserLoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user || Hash::check($request->password, $user->password) == false) {
            return response()->json(['message' => 'Invalid User']);
        }
        $token = $user->createToken('auth_token')->plainTextToken;
        $message = __('dashboard.You have successfully logged in');
        $data = [
            'token' => $token,
            'user' => $user
        ];
        return $this->apiResponse($data, $message, 200);
    }
}
