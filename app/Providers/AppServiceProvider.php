<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Kreait\Firebase\Contract\Firestore;
use Kreait\Firebase\Firestore as FirebaseFirestore;
use Milon\Barcode\Facades\DNS2DFacade;
use Illuminate\Support\Facades\Storage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Firestore::class, FirebaseFirestore::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()

    {

    }
}
