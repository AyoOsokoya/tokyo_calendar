<?php

namespace Database\Factories;

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
            'name' => '',
            'coordinates' => '',
            'country' => '',
            'postcode' => '',
            'state' => '',
            'city' => '',
            'street' => '',
            'building_name_number' => '',
            'custom' => '',
        ];
    }

    public function configure(): static
    {
        return $this->afterMaking(function () {
        });
    }
}
