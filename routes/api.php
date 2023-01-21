<?php

use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\Auth\AuthenticationController;
use App\Http\Controllers\Api\FreelancerServiceController;
use App\Http\Controllers\Api\OrderController;

Route::post('register', [AuthenticationController::class, 'register'])->name('authentication.register');
Route::post('login', [AuthenticationController::class, 'login'])->name('authentication.register');

// Route::middleware(['ActiveUser'])->group(function () {
// Route::post('login', [AuthenticationController::class, 'login'])->name('authentication.login');
// });



Route::post('socialite', [AuthenticationController::class, 'socialite']);

Route::post('forget-password', [AuthenticationController::class, 'forgetPassword']);
Route::post('check-code', [AuthenticationController::class, 'CheckCodeResetPassword']);

Route::middleware(['auth:sanctum'])->group(function () {




    Route::middleware(['freelancer','ActiveUser'])->prefix('freelancer/')->group(function () {

        Route::get('home', [ServiceController::class, 'limitService']);
        Route::resource('services', FreelancerServiceController::class);
        Route::resource('orders', OrderController::class);
        Route::post('order/create', [OrderController::class, 'create']);
    });

    Route::middleware(['recruiter','ActiveUser'])->prefix('recruiter/')->group(function () {
        Route::resource('categories', \App\Http\Controllers\Api\CategoryController::class);
        Route::resource('sub-categories/{category}', [\App\Http\Controllers\Api\CategoryController::class,'subCategory']);
        Route::resource('services', ServiceController::class)->only('store', 'index','show','destroy');
        Route::get('last-services',[ServiceController::class,'lastServices']);
        Route::post('accept-offer/{order}', [ServiceController::class,'acceptOffer']);

    });
    Route::get('search' , [\App\Http\Controllers\Application\Home\HomePageController::class , 'search']);

    Route::post('reset-password', [AuthenticationController::class, 'resetPassword']);
    Route::get('sliders' , [\App\Http\Controllers\Application\Home\HomePageController::class , 'index']);
    Route::post('user-profile', \App\Http\Controllers\Api\UserProfileController::class);
    Route::get('profile', [\App\Http\Controllers\Api\UserProfileController::class,'profile']);
    Route::get('notifications', [\App\Http\Controllers\Api\NotificationController::class, 'index']);
    Route::post('contact-us', \App\Http\Controllers\Api\ContactUsController::class);
    Route::get('about-us', [SettingController::class, 'aboutUs']);
    Route::get('privacy-policy', [SettingController::class, 'privacyPolicy']);

});
