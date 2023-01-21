<?php

namespace App\Http\Controllers\Api;

use App\Actions\App\Api\UpdateFirestore;
use App\Actions\App\ChangeStatus;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\PaginateController;
use App\Http\Resources\DriverResource;
use App\Models\Driver;
use App\Models\User;
use App\Traits\GetIndexData;
use Illuminate\Http\Request;
use Kreait\Firebase\Firestore;

class DriverController extends Controller
{
    public function __construct()
    {
//        $this->middleware(['permission:drivers-read'], ['only' => ['index']]);
//        $this->middleware(['permission:drivers-update'], ['only' => ['update']]);
//        $this->middleware(['permission:drivers-delete'], ['only' => ['destroy']]);
    }

    use GetIndexData;

    public function index(Request $request)
    {

//        return $this->data(new Driver());
        if ($request->ajax()) {
            if ($request['query']) {
                if (isset($request['query']['filter.status']) || isset($request['query']['filter.connection']) || $request['query']['filter.approve'])
                    session(['offline' => false]);
            }
            $drivers = Driver::search();
            return PaginateController::paginate($drivers, $request, 'App\Http\Resources\DriverResource');
        }


    }

    public function update(Driver $driver, UpdateFirestore $updateFirestore, Firestore $firestore)
    {

        $changeStatus = new ChangeStatus($driver, $updateFirestore);
        if (request('update') === 'status') {
            if ($driver->available == 1) {
                $suggested_order_id = $firestore->database()->collection(config('global.collection_drivers'))->document($driver->id)->snapshot()->data()['suggested_order_id'];

                if (!is_null($suggested_order_id)) {
                    $updateFirestore->update(config('global.collection_orders'), $suggested_order_id, [
                        ['path' => 'suggested_driver', 'value' => null],
                    ]);
                }

                $changeStatus->update();
            } else {
                return response()->json([
                    "status" => false,
                    "message" => "This is Driver Is Busy"
                ]);
            }
        } else {
            $changeStatus->update();
        }

    }

    public function destroy(Firestore $firestore)
    {
        $driver = Driver::findOrFail(request('id'));
        $driver->user->delete();
        $driver->delete();

        $database = $firestore->database();
        $database->collection(config('global.collection_drivers'))->document(request('id'))->delete();
    }
}
