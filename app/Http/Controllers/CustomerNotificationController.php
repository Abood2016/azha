<?php

namespace App\Http\Controllers;

use App\Actions\App\ValidateAndStoreImage;
use App\Http\Requests\NotificationRequest;
use App\Jobs\SendCustomNotificationToCustomers;
use App\Models\Customer;
use App\Models\CustomerNotification;
use Illuminate\Support\Facades\DB;

class CustomerNotificationController extends Controller
{
    public function create()
    {
        return view('pages.notification.customer.create', [
            'page_title' => __('Send Notification To All Customers')
        ]);
    }

    public static function store($specificCustomerNotificationRequest, $photo)
    {
        DB::beginTransaction();
        Customer::select('id', 'user_id')->with('user')->chunk(30, function ($customers) use ($specificCustomerNotificationRequest, $photo) {
            foreach ($customers as $customer) {
                $last_change = $customer->user->changesLang->where('active',1)->first();
                $user = $customer->user;
                SendCustomNotificationToCustomers::dispatch($user, $specificCustomerNotificationRequest, $photo, $last_change ? $last_change->lang : 'en'
                    , $user->promotion_push_notification, $user->is_new);
            }
        });

        DB::commit();

    }
}
