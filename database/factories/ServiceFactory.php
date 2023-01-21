<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Service::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'base_fare' => $this->faker->randomNumber(2),
            'minimum_fare' => $this->faker->randomNumber(2),
            'per_minute' => $this->faker->randomNumber(2),
            'per_km' => $this->faker->randomNumber(2),
            'commission' => $this->faker->randomNumber(2),
            'image' => 'https://picsum.photos/200',
        ];
    }
}
