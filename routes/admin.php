<?php

use App\Http\Controllers\Dashboard\Auth\Passwords\ForgetPasswordController;
use App\Http\Controllers\Dashboard\Auth\Passwords\RestPasswordController;
use App\Http\Controllers\Dashboard\Auth\AuthController;
use App\Http\Controllers\Dashboard\HomeController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Route::group(
            [
                'as' => 'dashboard.',
                'prefix' => 'dashboard',

            ],
            function () {
                Route::controller(AuthController::class)->name('login.')->group(function () {
                    Route::get('/login', 'showLoginForm')->name('showLoginForm');
                    Route::post('/login', 'login')->name('post');
                    Route::post('/logout', 'logout')->name('logout');

                });
                Route::group(['prefix' => 'password', 'as' => 'password.'], function () {
                    Route::get('email', [ForgetPasswordController::class, 'showEmailForm'])->name('showEmailForm');
                    Route::post('email', [ForgetPasswordController::class, 'sendOtp'])->name('sendOtp');
                    Route::get('confirm/{email}', [ForgetPasswordController::class, 'showConfirmForm'])->name('showConfirmForm');
                    Route::post('confirm/', [ForgetPasswordController::class, 'verifyOtp'])->name('verifyOtp');
                    Route::get('rest/{email}', [RestPasswordController::class, 'showRestForm'])->name('showRestForm');
                    Route::post('rest/', [RestPasswordController::class, 'rest'])->name('rest');

                });
                Route::group(
                    ['middleware' => ['auth:admin']],
                    function () {
                        Route::get('/home', [HomeController::class, 'index'])->name('home');
                    }

                );
            }
        );
    }
);

