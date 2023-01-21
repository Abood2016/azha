<?php

namespace App\Http\Controllers;

use App\Actions\App\CreateUser;
use App\Actions\App\CreateValidPhoneNumber;
use App\Actions\App\UpdateUser;
use App\Http\Requests\CustomerRequest;
use App\Http\Requests\UserRequest;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    private $createValidPhoneNumber;
    public function __construct()
    {
        $this->createValidPhoneNumber = new CreateValidPhoneNumber;
        $this->middleware(['permission:customers-create'], ['only' => ['store','create']]);
        $this->middleware(['permission:customers-read'], ['only' => ['index']]);
        $this->middleware(['permission:customers-update'], ['only' => ['update','edit']]);
    }
    public function index()
    {
        return view('pages.customer.index', [
            'page_title' => __('العملاء'),
        ]);
    }

    public function create()
    {
        return view('pages.customer.create', [
            'page_title' => __('Create Customer'),
        ]);
    }

    public function store(CustomerRequest $request, UserRequest $userRequest, CreateUser $createUser)
    {
        $userRequest->merge([
            'phone' => '+'.str_slug($this->createValidPhoneNumber->createPhone($userRequest->phone))
        ]);
        $userRequest->validate([
            'phone' => ['required', Rule::unique('users')],
        ]);

        DB::beginTransaction();

        $user = $createUser->create($userRequest, 2);
        $user->deposit(1000);
        $user->customer()->create($request->validated());

        DB::commit();

        return redirect()->route('customers.index')->with(config('global.notification_add'));
    }

    public function edit(Customer $customer)
    {
        return view('pages.customer.edit', [
            'page_title' => __('Edit') . ' ' . $customer->user->name,
            'customer' => $customer
        ]);
    }

    public function update(CustomerRequest $customerRequest, UserRequest $userRequest, Customer $customer, UpdateUser $updateUser)
    {
        $userRequest->merge([
            'phone' => '+'.str_slug($this->createValidPhoneNumber->createPhone($userRequest->phone))
        ]);
        $userRequest->validate([
            'phone' => ['required', Rule::unique('users')->ignore($customer->user->id)],
        ]);
        DB::beginTransaction();

        $user = $customer->user;

        $updateUser->update($userRequest, $customer->user);

        $user->customer->update($customerRequest->validated());
        if (isset($userRequest['photo'])) {
//            $user->updateProfilePhoto($userRequest['photo']);
            $imageName = time() . '.' . $customerRequest->photo->getClientOriginalName();
            $userRequest->file('photo')->storeAs('profile-photos', $imageName);
            $user->profile_photo_path = $imageName;
            $user->save();
        }
        DB::commit();

        return redirect()->route('customers.index')->with(config('global.notification_edit'));
    }

}
