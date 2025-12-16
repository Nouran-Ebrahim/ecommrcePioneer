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
        // abilities zay permessions keda 3la 7asab no3 2l user type writer or regular user wana ba3ml login b5tar no3 2l user
        //وبعدين اديله الابليتز وانا بعمل كريت للتوكين فهيتسجل ف جدول البرسونال اكسس توكين الابليتز بتاعت التوكين ده فكده اقدر اطبق ميديل وير بتاع الابليتز ع رواتس معينه ميقدرش يدخل الرواتس دي غير اللي معه الابليتز دي
        // lesson 150

        $token = $user->createToken('auth_token')->plainTextToken;
        $message = __('dashboard.You have successfully logged in');
        //resourse UserResourse::make($user) or New UserResourse($user->load(['country','city','governorate'])) لو يوزر واحد
        // for collections UserResourse::collection($users)
        $data = [
            'token' => $token,
            'user' => $user->load(['country','city','governorate'])
        ];
        return $this->apiResponse($data, $message, true,200);
    }
}
