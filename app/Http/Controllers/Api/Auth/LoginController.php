<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\User;
use App\Services\Website\ProductService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use ApiResponse;
    public $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
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
            'user' => $user->load(['country', 'city', 'governorate'])
        ];
        return $this->apiResponse($data, $message, true, 200);
    }
    public function getFlashProudcts()
    {
        $products = $this->productService->newAriavalsProducts();
        // ProductCollection if i want to add extra custom data from the productresourse like products counts or custom pagination
        // return $this->apiResponse(
        //     new ProductCollection($products),
        //     'Products retrieved successfully',
        //     true,
        //     200,

        // );
        // ->response()->getData(true) for defult pagination used with collection only
        // return $this->apiResponse(
        //     (new ProductCollection($products))->response()->getData(true),
        //     'Products retrieved successfully',
        //     true,
        //     200,

        // );
        // if i want to handle pagination in apiresponse trait
        return $this->apiResponse(
            ProductResource::collection($products),
            'Products retrieved successfully',
            true,
            200,
            $products
        );

    }
}
