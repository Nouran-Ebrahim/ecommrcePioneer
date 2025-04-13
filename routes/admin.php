<?php
use App\Http\Controllers\Dashboard\ContactController;
use App\Http\Controllers\Dashboard\SliderController;
use App\Http\Controllers\Dashboard\UserController;
use Livewire\Livewire;
use App\Http\Controllers\Dashboard\AttributeController;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\Auth\Passwords\ForgetPasswordController;
use App\Http\Controllers\Dashboard\Auth\Passwords\RestPasswordController;
use App\Http\Controllers\Dashboard\Auth\AuthController;
use App\Http\Controllers\Dashboard\BrandController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\CouponController;
use App\Http\Controllers\Dashboard\FaqController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\SettingController;
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
        'prefix' => LaravelLocalization::setLocale() . '/dashboard',
        'as' => 'dashboard.',
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
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
                Route::group(['middleware' => 'can:categories'], function () {
                    Route::resource('categories', CategoryController::class);
                    Route::get('categories-all', [CategoryController::class, 'getAll'])->name('categories.all');
                    Route::get('categories/{id}/status', [CategoryController::class, 'changeStatus'])->name('categories.status');
                });

                Route::group(['middleware' => 'can:brands'], function () {
                    Route::resource('brands', BrandController::class)->except('show');
                    Route::get('brands-all', [BrandController::class, 'getAll'])
                        ->name('brands.all');
                    Route::get('brands/{id}/status', [BrandController::class, 'changeStatus'])->name('brands.status');
                });


                Route::group(['middleware' => 'can:sliders'], function () {
                    Route::resource('sliders', SliderController::class)->except('show');
                    Route::get('sliders-all', [SliderController::class, 'getAll'])
                        ->name('sliders.all');
                    // Route::get('sliders/{id}/status', [SliderController::class, 'changeStatus'])->name('sliders.status');
                });

                Route::group(['middleware' => 'can:coupons'], function () {
                    Route::resource('coupons', CouponController::class)->except('show');
                    Route::get('coupons-all', [CouponController::class, 'getAll'])
                        ->name('coupons.all');
                    Route::get('coupons/{id}/status', [CouponController::class, 'changeStatus'])->name('coupons.status');
                });

                Route::group(['middleware' => 'can:faqs'], function () {
                    Route::resource('faqs', FaqController::class);
                    Route::get('faqs-all', [FaqController::class, 'getAll'])
                        ->name('faqs.all');
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
                Route::group(['middleware' => 'can:settings', 'as' => 'settings.'], function () {
                    Route::get('settings', [SettingController::class, 'index'])->name('index');
                    Route::put('settings/{id}', [SettingController::class, 'update'])->name('update');
                });
                Route::group(['middleware' => 'can:attributes'], function () {
                    Route::resource('attributes', AttributeController::class);
                    Route::get('attributes-all', [AttributeController::class, 'getAll'])
                        ->name('attributes.all');
                });

                Route::group(['middleware' => 'can:products'], function () {
                    Route::resource('products', ProductController::class);
                    Route::post('products/status', [ProductController::class, 'changeStatus'])
                        ->name('products.status');
                    Route::get('products-all', [ProductController::class, 'getAll'])
                        ->name('products.all');

                    //Variants
                    Route::get('products/variants/{variant_id}', [ProductController::class, 'deleteVariant'])
                        ->name('products.variants.delete');
                });
                Route::group(['middleware' => 'can:users'], function () {
                    Route::resource('users', UserController::class);
                    Route::post('users/status', [UserController::class, 'changeStatus'])
                        ->name('users.status');
                    Route::get('users-all', [UserController::class, 'getAll'])
                        ->name('users.all');
                });
                ############################### Contact Routes ##############################
                Route::group(['middleware' => 'can:contacts'], function () {
                    Route::get('contacts', [ContactController::class, 'index'])->name('contacts.index');
                    // Route::get('contacts-reply', [ContactController::class, 'getAll'])->name('users.all');
                });
                ############################### End Contacts ################################
            }

        );
        Livewire::setUpdateRoute(function ($handle) {
            return Route::post('/livewire/update', $handle);
        });

    }

);


