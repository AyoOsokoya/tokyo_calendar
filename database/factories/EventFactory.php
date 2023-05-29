<?php
declare(strict_types = 1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends Factory
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string => '', mixed>
     */
    public function definition(): array
    {
        $eventStart = Carbon::now();

        return [
            'name' => fake()->name,
            'description' => fake()->text,
            'source_id' => '1', // afterCreate...
            'location' => fake()->localCoordinates,
            'starts_at' => $eventStart,
            'ends_at' => $eventStart->addHours(fake()->randomDigitNotZero()) ,
            'gallery' => null, // after create
            'url' => fake()->url(),
            'email' => fake()->safeEmail(),
            'status' => '....', // TODO: random of ENUM
        ];
    }
}
