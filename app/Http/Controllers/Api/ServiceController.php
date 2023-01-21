<?php

namespace App\Http\Controllers\Api;

use App\Actions\App\Api\UpdateFirestore;
use App\Actions\App\ChangeStatus;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\PaginateController;
use App\Http\Resources\ServiceResource;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Recruiter;
use App\Models\Service;
use App\Models\User;
use App\Notifications\AcceptOrderNotification;
use App\Notifications\newServiceNotification;
use App\Traits\GetIndexData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ServiceController extends Controller
{
    use GetIndexData;


    public function index(Request $request)
    {

        $getRecruiter = Recruiter::where('user_id', auth()->user()->id)->first();

        $cancel = [2, 5, 6];
        $services = Service::where('recruiter_id', $getRecruiter->id)->whereNotIn('status', [3, 4])
            ->when(isset($request->status) && $request->status != 'null', function ($q) use ($request, $cancel) {
                if ($request->status == 2) {
                    return $q->whereIn('status', $cancel);
                }
                return $q->where('status', $request->status);
            })->orderBy('created_at', 'desc')->paginate($request->perpage ?? 10);
        return PaginateController::paginate($services, null, 'App\Http\Resources\ServiceResource');

    }

    public function show(Service $service)
    {
        $getRecruiter = Recruiter::where('user_id', auth()->user()->id)->first();
        if ($service->recruiter_id == $getRecruiter->id) {
            $service = Service::find($service->id);
            return response()->json([
                'status' => true,
                'data' =>    new ServiceResource($service)
            ]);

        } else {
            return response()->json([
                'status' =>  false,
                'message' =>   'الخدمة غير موجودة'
            ]);
        }

    }

    public function update(Service $service)
    {
        $changeStatus = new ChangeStatus($service);
        $changeStatus->update();
    }

    public function store(Request $request)
    {

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:sub_categories,id',
        ]);

        if($request->image){
            $imageName = time() . '.' . $request->image->getClientOriginalName();
            $request->file('image')->storeAs('services', $imageName);
        }


        $getRecruiter = Recruiter::where('user_id', auth()->user()->id)->first();

        $service = Service::create([
            'category_id'       => $request->category_id,
            'subcategory_id'    => $request->subcategory_id,
            'recruiter_id'      => $getRecruiter->id,
            'region'            => $request->region,
            'execution_time'    => $request->execution_time,
            'number_person'     => $request->number_person,
            'place_type'        => $request->place_type,
            'photography_type'  => $request->photography_type,
            'conditioning_type' => $request->conditioning_type,
            'car_type'          => $request->car_type,
            'count_photos'      => $request->count_photos,
            'count_videos'      => $request->count_videos,
            'polish_type'       => $request->polish_type,
            'delivery_area'     => $request->delivery_area,
            'residential_unit'  => $request->residential_unit,
            'count_workers'     => $request->count_workers,
            'spare_parts'       => $request->spare_parts,
            'year_production'   => $request->year_production,
            'image'             => $imageName ?? null,
            'message'           => $request->message,
            'name'              => $request->name
        ]);
        $admin = User::where('role', 0)->first();
        Notification::send($admin, new newServiceNotification($service));

        return response()->json([
            'status' => true,
            'message' =>   'تم اضافة الخدمة بنجاح , ستتم مراجعتها من قبل الأدارة'
        ]);
    }

    public function limitService()
    {
        $services = Service::with('category')->latest()->take(5)->get();;
        return returnData('data', ServiceResource::collection($services), 'some-services');
    }

    public function lastServices(){
        $services = auth()->user()->recruiter->services()->where('status' , 1)->latest()->take(5)->get();

        return response()->json([
            'status' => true,
            'data' =>   ServiceResource::collection($services)
        ]);
    }

    public function destroy(Service $service)
    {

        $getRecruiter = Recruiter::where('user_id', auth()->user()->id)->first();
        if ($service->recruiter_id == $getRecruiter->id) {
            $service->update([
                'status' => 2
            ]);
            return returnSuccessMessage('cancel success', 200);
        } else {
            return returnError(402, 'you dont have any permission for this service');
        }


    }

    public function acceptOffer(Request $request, Order $order)
    {

        $getRecruiter = Recruiter::where('user_id', auth()->user()->id)->first();

        if($order->status == 1 ){
            return response()->json([
                'status' => false,
                'message' => 'this offer already accepted'
            ]);
        }

        if ($order->recruiter_id == $getRecruiter->id) {
            $order->update([
                'status' => 1
            ]);

            $service = Service::where('id' , $order->service_id)->first();
            $service->update([
            'status' => 4
            ]);

            $getCustomer = Customer::where('id' , $order->customer_id)->first();
            $getUserId = $getCustomer->user_id;
            $user = User::where('id' , $getUserId)->first();

            Notification::send($user, new AcceptOrderNotification($order));

            return returnSuccessMessage('accept success', 200);
        } else {
            return returnError(402, 'you dont have any permission for this service');
        }

    }

}
