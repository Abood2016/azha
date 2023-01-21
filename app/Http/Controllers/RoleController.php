<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Helper\PaginateController;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    public function index(Request $request){
        $page_breadcrumbs = [
            ['page' => '/' , 'title' =>'Dashboard'],
        ];
        if($request->ajax()){
            $roles = Role::search($request)->paginate(10);
            return PaginateController::paginate($roles,$request);
        }
        return view('pages.role.index', [
            'page_breadcrumbs' =>$page_breadcrumbs,
            'page_title' =>__('Roles'),
        ]);
    }
    public function create(){
        $page_breadcrumbs = [
            ['page' => '/' , 'title' =>'Dashboard'],
        ];
        return view('pages.role.create', [
            'page_breadcrumbs' => $page_breadcrumbs,
            'page_title' =>__('Create Role'),
            'permissions' => getCustomRoles()
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','string','unique:roles,name'],
            'permissions' => ['required','array'],
        ]);
        DB::beginTransaction();
        $role = Role::create([
            'name' => $request->name,
            'display_name' => $request->name,
            'is_business' => $request->is_business?1:0,
        ]);
        $role->permissions()->attach($request->permissions);

        DB::commit();

        return back()->with(config('global.notification_add'));
    }

    public function edit(Role $role){
        $page_breadcrumbs = [
            ['page' => '/' , 'title' =>'Dashboard'],
            ['page' => '/roles' , 'title' =>'Roles'],
        ];
        $permissions = $role->permissions()->pluck('id')->toArray();
        return view('pages.role.edit', [
            'page_breadcrumbs' => $page_breadcrumbs,
            'role' => $role,
            'permissions' =>$permissions,
            'page_title' =>__('Edit Role'),
            'str_permissions' =>getCustomRoles(),
        ]);
    }
    public function update(Request $request,Role $role)
    {

        $request->validate([
            'name' => ['required','string',Rule::unique('roles')->ignore($role->id)],

            'permissions' => ['required','array'],
        ]);
        $role->update([
            'name' => $request->name,
            'display_name' => $request->name,
            'is_business' => $request->is_business?1:$role->is_business,
        ]);
        $pre_roles = $role->permissions()->pluck('id')->toArray();
        $role->permissions()->detach($pre_roles);
        $role->permissions()->attach($request->permissions);


        foreach ($role->users as $user){
            $user->permissions()->detach($pre_roles);
            $user->permissions()->attach($request->permissions);
        }
        DB::beginTransaction();

        DB::commit();

        return redirect()->route('roles.index')->with(config('global.notification_edit'));
    }

}
