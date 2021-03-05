<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(30),
            'details' => $this->faker->text,
            'price' => random_int(300, 500000),
            'quantity' => random_int(10, 500),
            'restaurant_id' => random_int(1, 9)
        ];
    }
}
