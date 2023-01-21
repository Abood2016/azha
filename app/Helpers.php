<?php

use App\Classes\Timeout;
use App\Models\Permission;

if (!function_exists('setTimeout')) {
    function setTimeout($cb, $time, ...$args)
    {
        static $count = 0;
        $id = "timeout$count";
        $GLOBALS[$id] = new Timeout($cb, $time, $args);
        $GLOBALS[$id]->run();
        $count++;
    }

    function getCustomRoles()
    {
        $string_permissions = Permission::all()->pluck('display_name')->toArray();
        $string_models = array();
        foreach ($string_permissions as $per) {
            $result = explode(' ', $per);
            array_push($string_models, $result[1]);
        }
        return array_unique($string_models);
    }

    function getLang()
    {
        if (\Illuminate\Support\Str::contains(request()->url(), 'api')) { // api
            $lang = request()->server('HTTP_ACCEPT_LANGUAGE') ?? 'en';
        } else {
            $lang = \App::getLocale();
        }
        return $lang;
    }

}
