<?php

namespace App\Providers;

use App\Events\PendingTrip;
use App\Listeners\RequirePassPhrase;
use App\Listeners\SendNotificationToCustomerForPendingTrip;
use App\Listeners\StopSuggestDrivers;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
            RequirePassPhrase::class
        ],
        PendingTrip::class => [
            SendNotificationToCustomerForPendingTrip::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
