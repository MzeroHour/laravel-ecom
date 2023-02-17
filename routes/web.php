<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// Admin Pannel
Route::prefix('admin/')->namespace('App\Http\Controllers\Admin')->group(function(){
    // Admin Dashboard Route with admin group
    //Route::get('login', 'AdminController@login');
    Route::match(['get', 'post'],'login', 'AdminController@login');

    Route::group(['middleware'=>['admin']],function () {
        // Admin Dashboard Route
        // Route::get('admin/dashboard', [AdminController::class, 'dashboard']);
        Route::get('dashboard', 'AdminController@dashboard');

        // Update Admin Password
        Route::match(['get', 'post'], 'update-admin-password', 'AdminController@updateAdminPassword');

        // Check Current Admin Password
        Route::post('check-admin-password', 'AdminController@checkAdminPassword');

        //Update Admin Details
        Route::match(['get', 'post'], 'update-admin-details', 'AdminController@updateAdminDetails');

        //Update Vendor Detailss
        Route::match(['get', 'post'], 'update-vendor-details/{slug}', 'AdminController@updateVendorDetails');

        //View All Admin / Subadmin/ Vendors
        Route::get('admins/{type?}','AdminController@admins');

        //View Admin / Vendor/ Detail
        Route::get('view-vendor-details/{id}', 'AdminController@viewVendorDetails');

        //Update Admin status
        Route::post('update-admin-status', 'AdminController@updateAdminStatus');
        // Route::post('update-admin-status', function(){
        //     return 'Success! ajax in laravel 5';
        // });

        //View Sections
        Route::get('sections', 'SectionController@sections');
        Route::post('update-section-status', 'SectionController@updateSectionStatus');
        //Delete section with ajax
        Route::get('delete-section/{id}', 'SectionController@deleteSection');
        Route::match(['get', 'post'], 'add-edit-section/{id?}', 'SectionController@addEditSection');

        //View Brands
        Route::get('brands', 'BrandController@brands');

        //Categories
        Route::get('categories', 'CategoryController@categories');
        Route::post('update-category-status', 'CategoryController@updateCategoryStatus');
        Route::match(['get', 'post'], 'add-edit-category/{id?}', 'CategoryController@addEditCategory');
        //Ajax Append Category Level
        Route::get('append-categories-level', 'CategoryController@appendCategoryLevel');
        //Delete Category with ajax
        Route::get('delete-category/{id}', 'CategoryController@deleteCategory');


        //logout
        Route::get('logout', 'AdminController@logout');
    });

});





