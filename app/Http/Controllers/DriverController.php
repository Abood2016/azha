<?php

namespace App\Http\Controllers;

use App\Actions\App\Api\SetToFirestore;
use App\Actions\App\CreateUser;
use App\Actions\App\CreateValidPhoneNumber;
use App\Actions\App\UpdateUser;
use App\Http\Requests\DriverRequest;
use App\Http\Requests\UserRequest;
use App\Models\Driver;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class DriverController extends Controller
{
    private $createValidPhoneNumber;

    public function __construct()
    {
        $this->createValidPhoneNumber = new CreateValidPhoneNumber;
        $this->middleware(['permission:drivers-create'], ['only' => ['store', 'create']]);
        $this->middleware(['permission:drivers-read'], ['only' => ['index']]);
        $this->middleware(['permission:drivers-update'], ['only' => ['update', 'edit']]);
    }

    public function index(Request $request)
    {
        if (!$request->ajax() && $request->offline) {
            session(['offline' => true]);
        } elseif (!$request->ajax() && !$request->offline) {
            session(['offline' => false]);
        }
        return view('pages.driver.index', [
            'page_title' => __('Drivers'),
        ]);
    }

    public function create()
    {
        return view('pages.driver.create', [
            'page_title' => __('Create Driver'),
        ]);
    }

    public function store(DriverRequest $driverRequest, UserRequest $userRequest, SetToFirestore $setToFirestore, CreateUser $createUser)
    {
        $userRequest->merge([
            'phone' => '+' . str_slug($this->createValidPhoneNumber->createPhone($userRequest->phone))
        ]);
        $userRequest->validate([
            'phone' => ['required', Rule::unique('users')],
        ]);
        DB::beginTransaction();

        $user = $createUser->create($userRequest, 3);
//        $user->deposit(1000);

//        $user->driver()->create(['created_by' => auth()->user()->name] + $driverRequest->validated());
        Service::find(1)->drivers()->create(['created_by' => auth()->user()->name] + $driverRequest->validated() + ['user_id' => $user->id]);

        $setToFirestore->set('drivers', $user->driver->id, $user->driver->toArray() + ['count_active_orders' => 0, 'suggested_order_id' => null]);

        DB::commit();

        return redirect()->route('drivers.index')->with(config('global.notification_add'));
    }

    public function show(Driver $driver)
    {
        return view('pages.driver.show', [
            'page_title' => $driver->user->name,
            'driver' => $driver
        ]);
    }

    public function edit(Driver $driver)
    {
        return view('pages.driver.edit', ['driver' => $driver]);
    }

    public function update(DriverRequest $driverRequest, UpdateUser $updateUser, UserRequest $userRequest, Driver $driver, SetToFirestore $setToFirestore)
    {

        $userRequest->merge([
            'phone' => '+' . str_slug($this->createValidPhoneNumber->createPhone($userRequest->phone))
        ]);
        $userRequest->validate([
            'phone' => ['required', Rule::unique('users')->ignore($driver->user->id)],
        ]);
        DB::beginTransaction();
        $user = $driver->user;

        $updateUser->update($userRequest, $user);

        $driver->update($driverRequest->validated());
        if (isset($userRequest['photo'])) {
//            $user->updateProfilePhoto($userRequest['photo']);
            $imageName = time() . '.' . $userRequest->photo->getClientOriginalName();
            $userRequest->file('photo')->storeAs('profile-photos', $imageName);
            $user->profile_photo_path = $imageName;
            $user->save();
        }
        $setToFirestore->set('drivers', $user->driver->id, $driver->toArray() + ['count_active_orders' => 0, 'suggested_order_id' => null]);

        DB::commit();

        return redirect()->route('drivers.index')->with(config('global.notification_edit'));
    }
}
