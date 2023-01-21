<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'url_facebook' => 'https://www.facebook.com/',
            'url_instagram' => 'https://www.instagram.com/',
            'url_twitter' => 'https://www.twitter.com/',
            'about_us' => 'https://www.facebook.com/',
            'privacy' => 'https://www.instagram.com/',
            'terms' => 'https://www.twitter.com/',
            'logo' => 'settings/logo.png',
            'color' => '#3C89F6',
        ]);
    }
}
