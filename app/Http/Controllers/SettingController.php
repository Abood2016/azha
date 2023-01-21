<?php

namespace App\Http\Controllers;

use App\Actions\App\ValidateAndStoreImage;
use App\Http\Requests\SettingRequest;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        return view('pages.setting.create', [
            'page_title' => __('الأعدادت العامة'),
            'settings' => Setting::all()->first()
        ]);
    }

    public function create()
    {
        return view('pages.setting.create', [
            'page_title' => __('الأعدادت العامة'),
            'settings' => Setting::all()->first()
        ]);
    }

    public function store(SettingRequest $settingRequest, ValidateAndStoreImage $validateAndStoreImage)
    {
        $setting = Setting::first();

        $setting->update(
            $settingRequest->validated() +
            $validateAndStoreImage->store('logo', 'settings', ['dimensions:width=92, height=12', 'max:2048'])
        );

        return back()->with(config('global.notification_edit'));
    }
}
