<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Destination;

class DestinationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Destination::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->text,
            'image' => $this->faker->regexify('[A-Za-z0-9]{100}'),
            'price' => $this->faker->numberBetween(-10000, 10000),
            'is_open' => $this->faker->numberBetween(-8, 8),
        ];
    }
}
