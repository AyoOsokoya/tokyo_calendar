<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Domains\Location\Models\Location;
use App\Domains\Location\Models\Tables\TableLocation as _;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocationFactory extends Factory
{
    protected $model = Location::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            _::country => '',
            _::city => fake()->city(),
            _::state => fake()->city(),
            _::street_address => fake()->streetAddress(),
            _::post_code => fake()->postcode(),
            _::other => fake()->address(),
            _::longitude => fake()->longitude(),
            _::latitude => fake()->latitude()
        ];
    }

    public function configure(): static
    {
        return $this->afterMaking(function () {
        })->afterCreating(function () {
        });
    }
}
