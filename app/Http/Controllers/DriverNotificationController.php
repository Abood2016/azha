<?php

namespace App\Http\Controllers;

use App\Actions\App\ValidateAndStoreImage;
use App\Http\Requests\NotificationRequest;
use App\Jobs\SendCustomNotificationToCustomers;
use App\Jobs\SendCustomNotificationToDrivers;
use App\Models\Customer;
use App\Models\CustomerNotification;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DriverNotificationController extends Controller
{
    public function create()
    {
        return view('pages.notification.driver.create', [
            'page_title' => __('Send Notification To All Driver')
        ]);
    }

    public static function store($specificCustomerNotificationRequest, $photo)
    {

        DB::beginTransaction();

        Driver::select('id', 'user_id')->with('user')->chunk(30, function ($drivers) use ($specificCustomerNotificationRequest, $photo) {
            foreach ($drivers as $driver) {
                $last_change = $driver->user->changesLang->where('active',1)->first();
                $user = $driver->user;
                SendCustomNotificationToDrivers::dispatch($user, $specificCustomerNotificationRequest, $photo, $last_change ? $last_change->lang : 'en'
                    , $user->promotion_push_notification);
            }
        });

        DB::commit();
        die();
        DB::beginTransaction();

        $notificationData = CustomerNotification::create(
            [
                'title' => $notificationRequest->title,
                'body' => $notificationRequest->body,
            ] + $validateAndStoreImage->store('image', 'notifications', ['max:1024'])
        );

        Driver::select('id', 'user_id')->chunk(30, function ($drivers) use ($notificationData) {
            foreach ($drivers as $driver) {
                SendCustomNotificationToDrivers::dispatch($driver, $notificationData, $driver->user->push_notification ? true : false);
            }
        });

        DB::commit();

//        return back()->with(config('global.notification_send'));
    }
}
