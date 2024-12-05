<?php

use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\Auth\Passwords\ForgetPasswordController;
use App\Http\Controllers\Dashboard\Auth\Passwords\RestPasswordController;
use App\Http\Controllers\Dashboard\Auth\AuthController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\WorldController;
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

                        Route::group(['middleware' => 'can:roles'], function () {
                            Route::resource('roles', RoleController::class);

                        });
                        Route::group(['middleware' => 'can:admins'], function () {
                            Route::resource('admins', AdminController::class);
                            Route::get('admins/{id}/status', [AdminController::class, 'changeStatus'])->name('admins.status');


                        });
                        Route::group(['middleware' => 'can:global_shipping'], function () {
                            Route::controller(WorldController::class)->group(function () {

                                Route::prefix('countries')->name('countries.')->group(function () {
                                    Route::get('/', 'getAllCountries')->name('index');
                                    Route::get('/{country_id}/governorates', 'getGovByCountryId')->name('governorates.index');
                                    Route::get('/change-status/{country_id}', 'changeStatus')->name('status');

                                });

                                Route::prefix('governorates')->name('governorates.')->group(function () {
                                    Route::get('/change-status/{gov_id}', 'changeGovStatus')->name('status');
                                    Route::put('/shipping-price', 'changeShippingPrice')->name('shipping-price');
                                });

                            });
                        });
                    }

                );
            }
        );
    }
);

