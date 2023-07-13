<?php
declare(strict_types = 1);

namespace Database\Factories;

use App\Enums\EnumEventSourceDataType;
use App\Models\EventSource;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<EventSource>
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
        $name_display = fake()->domainName();
        return [
            'name_display' => $name_display,
            'name_display_short' => $name_display,
            'name_importer' => fake()->sha256,
            'event_source_data_type' => EnumEventSourceDataType::SCRAPE,
            'command_name' => 'command_name',
            'command_parameters' => '-r -c', // recursive, clobber
            'base_url' => fake()->url(),
        ];
    }
}
