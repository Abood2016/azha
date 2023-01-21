<?php

namespace Database\Seeders;

use App\Actions\App\Api\SetToFirestore;
use App\Models\BusinessSetting;
use App\Models\Order;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Driver;
use App\Models\PendingPeep;
use App\Models\Service;
use App\Models\SettingOrder;
use App\Models\SubCategory;
use App\Models\Type;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Kreait\Firebase\Firestore;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $categories = config('categories');
        foreach ($categories as $index => $category) {
            $category += ['name' => $this->convert($category['key'])];
            Category::create($category);
        }
        $subCategories = config('subcategories');
        foreach ($subCategories as $index => $subcategory) {
            $subcategory += ['name' => $this->convert($subcategory['key'])];
            SubCategory::create($subcategory);
        }



        $this->call([
            LaratrustSeeder::class,
            AdminSeeder::class,
            SettingSeeder::class,
        ]);
    }

    public function convert($string)
    {
        $array = explode('_', $string);
        $string = '';
        foreach ($array as $str) {
            $string .= ucfirst($str) . ' ';
        }
        return ucfirst($string);
    }
}
