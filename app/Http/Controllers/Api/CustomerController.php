<?php

namespace App\Http\Controllers\Api;

use App\Actions\App\Api\UpdateFirestore;
use App\Actions\App\ChangeStatus;
use App\Actions\App\CreateUser;
use App\Actions\App\CreateValidPhoneNumber;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\PaginateController;
use App\Http\Requests\CustomerRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Traits\GetIndexData;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
class CustomerController extends Controller
{
    private $createValidPhoneNumber;
    public function __construct()
    {
        $this->createValidPhoneNumber = new CreateValidPhoneNumber;
    }

    use GetIndexData;

    public function index(Request $request)
    {
        if($request->ajax()){
            $customers = Customer::search($request->data);
            return PaginateController::paginate($customers,$request,'App\Http\Resources\CustomerResource');
        }
    }

    public function store(UserRequest $userRequest , CreateUser $createUser){
        $userRequest->merge([
            'phone' => '+'.str_slug($this->createValidPhoneNumber->createPhone($userRequest->phone))
        ]);
        $userRequest->validate([
            'phone' => ['required', Rule::unique('users')],
        ]);
       $user =  $createUser->create($userRequest, 2);
        $customer = $user->customer()->create([]);
       return response()->json([
           'customer' =>[
               'name' => $user->name,
               'id' => $customer->id,
           ]
       ]);
    }

    public function update(Customer $customer)
    {
        $changeStatus = new ChangeStatus($customer);
        $changeStatus->update();
    }

    public function destroy()
    {
        $customer= Customer::findOrFail(request('id'));
       $customer->user->delete();
       $customer->delete();

    }
}
