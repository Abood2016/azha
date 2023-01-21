<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = Permission::all();
        $admin =  User::create([
            'name' => 'Admin',
            'email' => 'admin@azhal.com',
            'phone' => '555555555',
            'email_verified_at' => now(),
            'role' => 0,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);
        $admin->attachRole('super_admin');
        foreach ($permissions as $permission){
            $admin->attachPermission($permission->name);
        }
    }
}
