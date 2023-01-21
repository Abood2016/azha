<?php

namespace App\Http\Controllers;

use App\Actions\App\CreateValidPhoneNumber;
use App\Http\Controllers\Helper\PaginateController;
use App\Http\Requests\AdminRequest;
use App\Models\Permission;
use App\Models\Place;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    private $auth ;
    private $createValidPhoneNumber ;
    public function __construct()
    {


        $this->auth = app('firebase.auth');
        $this->createValidPhoneNumber = new CreateValidPhoneNumber;
        $this->middleware(['permission:admins-create'], ['only' => ['store','create']]);
        $this->middleware(['permission:admins-read'], ['only' => ['index']]);
        $this->middleware(['permission:admins-update'], ['only' => ['update','edit']]);
        $this->middleware(['permission:admins-delete'], ['only' => ['destroy']]);
    }
    public function index(Request $request){
        if($request->ajax()){
            $admins = User::search(User::ROLES[1]);
            return PaginateController::paginate($admins,$request);
        }
        return view('pages.admin.index', [
            'page_title' => __('Admins'),
        ]);
    }
    public function create(){
        return view('pages.admin.create', [
            'page_title' => __('Create Admin'),
            'roles' => Role::where('is_business',0)->get(),
            'places' => Place::where('active',1)->get()
        ]);
    }
    public function store(AdminRequest $adminRequest){

        $adminRequest->validate([
            'password'=> ['required'],
            'confirm_password'=> ['required'],
        ]);
        if($adminRequest->password != $adminRequest->confirm_password){
            return redirect()->back()->with('error', 'passwords do not match');
        }
        $imageName = null;
        if($adminRequest->photo){
            $imageName = time() . '.' .  $adminRequest->photo->getClientOriginalName();
            $adminRequest->file('photo')->storeAs('profile-photos', $imageName);
        }
        try{
            DB::beginTransaction();
            $userProperties = [
                'name' => $adminRequest->name,
                'email' => $adminRequest->email,
                'email_verified_at' => now(),
                'role' => 1,
                'password' => Hash::make($adminRequest->password),
                'profile_photo_path' =>$imageName
            ];
            $admin =  User::create($userProperties);
            $role = Role::find($adminRequest->role_id);
            $admin->attachRole($adminRequest->role_id);
            $admin->permissions()->attach($role->permissions()->pluck('id')->toArray());
//            $this->auth->createUser($userProperties);
            DB::commit();
            return back()->with(config('global.notification_add'));
        }catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage());
        }

    }
    public function edit($admin){
        $user = User::find($admin);
        if($user && in_array($user->role,[0,1,4])){
            return view('pages.admin.edit', [
                'page_title' =>  __('Edit') . ' ' .$user->name,
                'user' => $user,
                'roles' => Role::where('is_business',0)->get(),
                'places' => Place::where('active',1)->get(),
                'roles_string' => Role::all()->pluck('name')->toArray()
            ]);
        }
        return redirect()->back();

    }
    public function update(AdminRequest $adminRequest,$admin){
        $admin = User::find($admin);
        if($adminRequest->password || $adminRequest->confirm_password){
            if($adminRequest->password != $adminRequest->confirm_password){
                return redirect()->back()->with('error', 'passwords do not match');
            }
        }

        $imageName = $admin->profile_photo_path;
        if($adminRequest->photo){
//            unlink(base_path().'/storage/app/public/profile-photos/'. $imageName);
            $imageName = time() . '.' . $adminRequest->photo->getClientOriginalName();
            $adminRequest->photo->storeAs('profile-photos', $imageName);
        }
        $role = Role::find($adminRequest->role_id);
        try{
            DB::beginTransaction();
            $properties = [
                'name' => $adminRequest->name,
                'email' => $adminRequest->email,
                'password' => $adminRequest->password?Hash::make($adminRequest->password):$admin->password,
                'profile_photo_path' =>$imageName,
            ];
//            $user_firebase = $this->auth->getUserByEmail($admin->email);
            $admin->update($properties);



//            $this->auth->updateUser($user_firebase->uid, $properties);
            $admin->update($properties);
            $admin->permissions()->detach($admin->permissions->pluck('id')->toArray());
            $admin->detachRoles($admin->roles->pluck('id')->toArray());
            $admin->attachRole($adminRequest->role_id);
            $admin->permissions()->attach($role->permissions()->pluck('id')->toArray());
            DB::commit();
            return back()->with(config('global.notification_edit'));
        }catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage());
        }

    }
    public function destroy($user){
        $admin = User::find($user);
        $admin->delete();
        return response()->json([
            'status' =>true,
            'message' => 'You have successfully Delete Admin'
        ]);
    }
}