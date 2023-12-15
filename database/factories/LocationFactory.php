<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Domains\Location\Models\Tables\TableLocation as _;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            _::country => '',
            _::city => '',
            _::state => '',
            _::street_address => '',
            _::post_code => '',
            _::other => '',
            _::longitude => '',
            _::latitude => '',
        ];
    }

    public function configure(): static
    {
        return $this->afterMaking(function () {
        })->afterCreating(function () {
        });
    }
}
