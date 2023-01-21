<?php

namespace App\Actions\App;

use App\Actions\App\Api\GetDistance;
use App\Actions\App\Api\SetToFirestore;
use App\Actions\App\Api\UpdateFirestore;
use App\Classes\Abstracts\Order as OrderAbstract;
use App\Http\Requests\AdminOrderRequest;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Jobs\DriverAcceptOrder;
use App\Jobs\MakeAdminAcceptOrder;
use App\Jobs\test;
use App\Models\ActivityOrder;
use App\Models\Customer;
use App\Models\Driver;
use App\Models\Location;
use App\Models\Order;
use App\Models\Place;
use App\Models\Service;
use App\Models\SettingOrder;
use App\Notifications\OrderAcceptedByDriver;
use App\Traits\CreateActivityOrder;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Kreait\Firebase\Firestore;
use Nette\IOException;

class CreateOrder extends OrderAbstract
{
    use CreateActivityOrder;

    public function create(AdminOrderRequest $adminOrderRequest, Firestore $firestore)
    {
    //
    }

  
  
}
