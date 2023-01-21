<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Api\OrderController as ApiOrderController;
use App\Http\Controllers\Api\CustomerController as ApiCustomerController;
use App\Http\Controllers\Api\DriverController as ApiDriverController;
use App\Http\Controllers\Api\RecruiterController as ApiRecruiterController;
use App\Http\Controllers\Api\GetCustomerOrdersController;
use App\Http\Controllers\Api\ServiceController as ApiServiceController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingController;
use \App\Http\Controllers\Dashboard\SliderController;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\RecruiterController;

Route::get('migrate', function () {
    Artisan::call('migrate:fresh --seed');
});


Route::group(
    [
        'middleware' => ['auth', 'admin']
    ],
    function () {
        Route::get('mark-as-read/{id}', function ($id) {
            $query = User::firstWhere('role', 0)->unreadNotifications()->where('id', $id)->first();
            $query->markAsRead();
            $redirect = $query['data']['link'];
            return redirect($redirect);
        });
        Route::get('/', DashboardController::class);

        // Admin middleware

        Route::middleware('admin')->group(function () {

            Route::resource('roles', RoleController::class)->except('update');
            Route::post('roles/{role}/update', [RoleController::class, 'update'])->name('roles.update');
            Route::resource('permissions', PermissionController::class);

            Route::prefix('sliders')->group(function () {
                Route::get('/', [SliderController::class, 'index'])->name('sliders.index');
                Route::get('create', [SliderController::class, 'create'])->name('sliders.create');
                Route::get('{slider}/edit', [SliderController::class, 'edit'])->name('sliders.edit');
                Route::post('/', [SliderController::class, 'store'])->name('sliders.store');
                Route::post('{slider}', [SliderController::class, 'update'])->name('sliders.update');
                Route::delete('{slider}', [SliderController::class, 'destroy'])->name('sliders.destroy');
                Route::post('{slider}/make-active', [SliderController::class, 'makeActive'])->name('sliders.makeActive');
            });

            Route::delete('category/{category}', [CategoryController::class, 'delete'])->name('categories.delete');
            Route::delete('sub-category/{subCategory}', [SubCategoryController::class, 'delete']);

            Route::resource('services', ServiceController::class);
            Route::post('services/status', [ServiceController::class, 'update'])->name('services.status');
            Route::resource('settings', SettingController::class);

            // Metronic datatable requests
            Route::prefix('metronic/')->group(function () {
                Route::get('services', [ApiServiceController::class, 'index'])->name('metronic.services');
            });
        });


        // Route::resource('admins', AdminController::class);
        Route::resource('drivers', DriverController::class);
        Route::resource('categories', CategoryController::class)->except('create','store');
        Route::resource('sub-categories', \App\Http\Controllers\SubCategoryController::class);
        Route::resource('recruiters', RecruiterController::class);
        Route::resource('customers', CustomerController::class);
        Route::resource('orders', OrderController::class);
        Route::get('contact-us', [ContactUsController::class, 'index'])->name('contact.index');
        Route::post('contact-us/delete', [ContactUsController::class, 'destroy'])->name('contact.destroy');

        // Metronic datatable requests
        Route::prefix('metronic/')->group(function () {
            // API
            Route::get('drivers', [ApiDriverController::class, 'index'])->name('metronic.drivers');
            Route::get('recruiter', [ApiRecruiterController::class, 'index'])->name('metronic.recruiters');
            Route::get('customers', [ApiCustomerController::class, 'index'])->name('metronic.customers');
            Route::get('orders', [ApiOrderController::class, 'index'])->name('metronic.orders');
            Route::get('customer/{customer}/orders', GetCustomerOrdersController::class)->name('customer.orders');
            // Actions
            // Update
            Route::post('recruiter/status', [ApiRecruiterController::class, 'update'])->name('metronic.recruiter.status');

            Route::post('service/status', [ApiServiceController::class, 'update'])->name('metronic.service.status');
            Route::post('driver/status', [ApiDriverController::class, 'update'])->name('metronic.driver.status');
            Route::post('customer/status', [ApiCustomerController::class, 'update'])->name('metronic.customer.status');
            Route::post('order/status', [ApiOrderController::class, 'update'])->name('metronic.order.status');

            // Delete
            Route::post('driver/destroy', [ApiDriverController::class, 'destroy'])->name('metronic.driver.destroy');
            Route::post('customer/destroy', [ApiCustomerController::class, 'destroy'])->name('metronic.customer.destroy');
            Route::post('order/destroy', [ApiOrderController::class, 'destroy'])->name('metronic.order.destroy');
        });

        Route::prefix('api')->group(function () {
            Route::get('drivers', [ApiDriverController::class, 'index']);
        });
    });


//Clear Cache facade value:
Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/optimize', function () {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/route-cache', function () {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function () {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function () {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function () {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});
Route::get('/symlink', function () {
    $code = Artisan::call('storage:link');
    return $code;
});

Route::get('fresh', function (){
    Artisan::call('migrate:fresh --seed');
});
