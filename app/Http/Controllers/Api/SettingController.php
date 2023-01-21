<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Traits\GetIndexData;

class SettingController extends Controller
{
    use GetIndexData;

    public function index()
    {
        return $this->data(new Setting());
    }

    public function aboutUs(Setting $setting)
    {
        $setting = Setting::first();
        return returnData('data', $setting->about_us, 'success');
    }

    public function privacyPolicy()
    {
        $setting = Setting::first();
        return returnData('data', $setting->privacy, 'success');
    }
}
