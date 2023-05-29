<?php
declare(strict_types = 1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EventSource>
 */
class EventSourceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->domainName(),
            'enum_event_source' => '', // TODO: use ENUM
            'handle' => fake()->userName(),
            'data_type' => '', // TOOD: use ENUM
            'command_name' => '',
            'command_parameters' => '',
            'base_url' => fake()->domainName(),
            'email' => fake()->email(),
            'phone_number' => fake()->companyEmail(),
        ];
    }
}
