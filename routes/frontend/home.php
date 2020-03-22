<?php
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\PartnershipsController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\User\AccountController;
use App\Http\Controllers\Frontend\User\DashboardController;
use App\Http\Controllers\Frontend\User\ProfileController;
use App\Http\Controllers\Frontend\CloudServiceController;
use App\Http\Controllers\Frontend\MyServicesController;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('about', [AboutController::class, 'index'])->name('index');
Route::get('services', [ServicesController::class, 'index'])->name('index');
Route::get('products', [ProductsController::class, 'index'])->name('index');
Route::get('partnerships', [PartnershipsController::class, 'index'])->name('index');
Route::get('blog', [BlogController::class, 'index'])->name('index');
Route::get('faq', [FaqController::class, 'index'])->name('index');
Route::get('contact', [ContactController::class, 'index'])->name('contact');
Route::get('team', [TeamController::class, 'index'])->name('index');
Route::get('events', [EventsController::class, 'index'])->name('index');

Route::post('contact/send', [ContactController::class, 'send'])->name('contact.send');

/*
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 * These routes can not be hit if the password is expired
 */
Route::group(['middleware' => ['auth', 'password_expires']], function () {
    Route::group(['namespace' => 'User', 'as' => 'user.'], function () {
        // User Dashboard Specific
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('cloud-service', [CloudServiceController::class, 'index'])->name('cloud_services');
        Route::get('cloud-service/view_service/{id}', [CloudServiceController::class, 'view_service'])->name('cloud_services.view');
        Route::post('cloud-service/insert_armc', [CloudServiceController::class, 'addservices'])->name('cloud_services.addservices');

        Route::get('my-services/indexing/', [MyServicesController::class, 'index'])->name('my_service.index');
        Route::get('my-services/open-service/{service_id}/{service_token}', [MyServicesController::class, 'open_service'])->name('my_service.open_service');


        // User Account Specific
        Route::get('account', [AccountController::class, 'index'])->name('account');

        // User Profile Specific
        Route::patch('profile/update', [ProfileController::class, 'update'])->name('profile.update');
    });
});