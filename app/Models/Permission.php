<?php

namespace App\Models;

use Laratrust\Models\LaratrustPermission;

class Permission extends LaratrustPermission
{
    public $guarded = [];
    public function adminPermissions(){
        return self::where('name','like','%admin%')->get();
    }
    public function driverPermissions(){
        return self::where('name','like','%driver%')->get();
    }
    public function typePermissions(){
        return self::where('name','like','%type%')->get();
    }
    public function placePermissions(){
        return self::where('name','like','%place%')->get();
    }
    public function tripPermissions(){
        return self::where('name','like','%trip%')->get();
    }
    public function servicePermissions(){
        return self::where('name','like','%service%')->get();
    }
    public function bookingPermissions(){
        return self::where('name','like','%order%')->get();
    }
    public function ratingPermissions(){
        return self::where('name','like','%rating%')->get();
    }
    public function walletPermissions(){
        return self::where('name','like','%wallet%')->get();
    }
    public function notificationPermissions(){
        return self::where('name','like','%notification%')->get();
    }
    public function peepPermissions(){
        return self::where('name','like','%peep%')->get();
    }
    public function settingPermissions(){
        return self::where('name','like','%setting%')->get();
    }
    public function supportPermissions(){
        return self::where('name','like','%support%')->get();
    }
    public function customerPermissions(){
        return self::where('name','like','%customer%')->get();
    }
}
