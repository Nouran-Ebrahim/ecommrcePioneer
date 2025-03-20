<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Website\HomeController;
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
// Route::redirect('/', '/home'); // this impostant as when i visit / he put home autmaticly and vite home page

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'as' => 'website',
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.get');
        Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
        
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.get');
        Route::post('/login', [LoginController::class, 'login'])->name('login.post');

        Route::get('/home', [HomeController::class, 'index'])->name('home');
    }
);


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
