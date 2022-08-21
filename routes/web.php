<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAuth;
use App\Http\Controllers\Home\HomeSliderController;
use App\Http\Controllers\Home\AboutController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('frontend/index');
})->name('home');
// About Page All Route 
Route::controller(AboutController::class)->group(function () {
    Route::get('/about', 'AllAboutPage')->name('home.about');
});



/*  --------------- */

Route::middleware(['auth','verified'])->group(function () {

    /*  Admin Panel Start */
    Route::controller(AdminController::class)->group(function () {

        // ------------------ Profile --------------------
        Route::get('admin/profile', 'Profile')->name('admin.profile');
        Route::get('admin/edit/profile', 'EditProfile')->name('edit.profile');
        Route::post('admin/store/profile', 'StoreProfile')->name('store.profile');

        // ------------------ Admin Dashboard ------------------
        Route::get('admin/dashboard', function () {
            return view('admin/index');
        })->name('admin.index');
        // 
    });

    // Home Slide All Route 
    Route::controller(HomeSliderController::class)->group(function () {
        Route::get('/home/slide', 'HomeSliderAdmin')->name('home.slide');
        Route::post('/update/slider', 'UpdateSliderAdmin')->name('update.slider');    
    });

    // About Page All Route 
    Route::controller(AboutController::class)->group(function () {
        Route::get('/about/page', 'AboutPageAdmin')->name('about.page'); 
        Route::post('/update/about', 'UpdateAboutAdmin')->name('update.about');
    });

});

    // Admin Auth Route 
    Route::controller(AdminAuth::class)->group(function () {

        // ------------------ Logout --------------------
        Route::get('/admin/logout', 'admin_destroy')->middleware(['auth','verified'])->name('admin.logout');

        // ------------------ Registration ------------------
        Route::get('/admin/register','create_registration')->middleware(['auth','verified'])->name('admin.register');
        Route::post('/admin/register', 'store_registration');

        // ------------------ Login --------------------
        Route::get('admin/login', 'create_login')->name('admin.login');
        Route::post('admin/login', 'store_login');

        // ------------------ Change Password --------------------
        Route::get('admin/change-password', 'ChangePassword')->name('change.password');
        Route::post('admin/update-password', 'UpdatePassword')->name('update.password');
        
    });

/*  --------------- */










// Route::get('dashboard', function () {
//     return view('admin/index');
// })->middleware(['auth','verified'])->name('admin.index');





require __DIR__.'/auth.php';
