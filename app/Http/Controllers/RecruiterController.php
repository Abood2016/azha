<?php

namespace App\Http\Controllers;

use App\Actions\App\CreateUser;
use App\Actions\App\CreateValidPhoneNumber;
use App\Actions\App\UpdateUser;
use App\Http\Requests\RecruiterRequest;
use App\Http\Requests\UserRequest;
use App\Models\Recruiter;
use App\Models\Role;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class RecruiterController extends Controller
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

        return view('pages.recruiter.index', [
            'page_title' => __('أصحاب الخدمات'),

        ]);

    }

    public function create()
    {
        return view('pages.recruiter.create', [
            'page_title' => __('أضافة صاحب خدمة'),
        ]);
    }

    public function store(RecruiterRequest $recruiterRequest, UserRequest $userRequest, CreateUser $createUser)
    {

        $userRequest->merge([
            'phone' =>$userRequest->phone
        ]);

        $userRequest->validate([
            'phone' => ['required', Rule::unique('users')],
        ]);

        DB::beginTransaction();
        $user = $createUser->create($userRequest, 2); // 5 =  status_recruiter

        $user->customer()->create($recruiterRequest->validated() + ['user_id' => $user->id]);

        DB::commit();

        return redirect()->route('customer.index')->with(config('global.notification_add'));
    }

    public function show(Recruiter $recruiter)
    {
        return view('pages.recruiter.show', [
            'page_title' => $recruiter->user->name,
            'recruiter' => $recruiter->load('services')
        ]);
    }

    public function edit(Recruiter $recruiter)
    {
        return view('pages.recruiter.edit', ['recruiter' => $recruiter]);
    }

    public function update(RecruiterRequest $recruiterRequest,UpdateUser $updateUser , UserRequest $userRequest, Recruiter $recruiter)
    {

        $userRequest->merge([
            'phone' => '+' . str_slug($this->createValidPhoneNumber->createPhone($userRequest->phone))
        ]);
        $userRequest->validate([
            'phone' => ['required', Rule::unique('users')->ignore($recruiter->user->id)],
        ]);
        DB::beginTransaction();


        $user = $recruiter->user;

        $updateUser->update($userRequest, $user);


        if (isset($userRequest['photo'])) {
            $imageName = time() . '.' . $userRequest->photo->getClientOriginalName();
            $userRequest->file('photo')->storeAs('profile-photos', $imageName);
            $user->profile_photo_path = $imageName;
            $user->save();

        }

        DB::commit();

        return redirect()->route('recruiters.index')->with(config('global.notification_edit'));
    }


}
