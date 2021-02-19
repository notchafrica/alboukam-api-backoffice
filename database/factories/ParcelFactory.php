<?php

namespace Database\Factories;

use App\Models\Parcel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class ParcelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Parcel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name(),
            'details' => $this->faker->text(),
            'user_id' => 1,
            'fee' => random_int(5, 50),
            'uid' => Parcel::uid(),
            'from' => $this->faker->country,
            'to' => $this->faker->country,
            'weight' => random_int(1, 20),
            'length' => random_int(1, 20),
            'type' => Arr::random(['envelop', 'box', 'documents', 'pallet'], 1)[0],
            'width' => random_int(1, 20),
            'status' => Arr::random(['confirmed', 'open', 'draft'], 1)[0]
        ];
    }
}
