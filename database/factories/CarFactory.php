<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CarFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Car::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'created_at' => now(),
            'updated_at' => now(),
            'description' => $this->faker->address . ' ' . Str::random(10),
            'counter' => $this->faker->biasedNumberBetween(1, 1_000_000),
            'name' => $this->faker->randomElement(['Piękny', 'Brzydki', 'Tani', 'Oszałamiający']) . " samochód " . $this->faker->unique()->name,
            'email' => $this->faker->unique()->safeEmail,
            'purchased_on' => now(),
            'liczba' => $this->faker->unique()->numberBetween(0,1000000)
        ];
    }
}
