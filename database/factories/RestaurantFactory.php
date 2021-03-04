<?php

namespace Database\Factories;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class RestaurantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Restaurant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(30),
            'city_id' => random_int(1, 139),
            'address' => $this->faker->address,
            'bio' => $this->faker->text(500),
            'phone' => $this->faker->phoneNumber,
            'type' => Arr::random(['restaurant', 'shop'], 1)[0]
        ];
    }
}
