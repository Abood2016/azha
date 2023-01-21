<?php

namespace Database\Factories;

use App\Models\Driver;
use Illuminate\Database\Eloquent\Factories\Factory;

class DriverFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Driver::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'licence_number'              => $this->faker->randomNumber(),
            'licence_expire_date'         => $this->faker->date('Y/m/d'),
            'vehicle_brand'               => $this->faker->word(),
            'vehicle_model'               => $this->faker->word(),
            'vehicle_name'                => $this->faker->word(),
            'vehicle_color'               => $this->faker->word(),
            'vehicle_registration_number' => $this->faker->randomNumber(),
            'vehicle_purchase_year'       => $this->faker->date('Y'),
            'connection'                  => 1,
            'coordinates'                 => [
                'lat' => $this->faker->latitude,
                'lng' => $this->faker->longitude
            ],
            'created_by' => 'factory'
        ];
    }
}
