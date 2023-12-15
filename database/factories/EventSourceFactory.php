<?php
declare(strict_types = 1);

namespace Database\Factories;

use App\Domains\Events\Enums\EnumEventSourceDataType;
use App\Domains\Events\Models\EventSource;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Domains\Events\Models\Tables\TableEventSource as _;

/**
 * @extends Factory<EventSource>
 */
class EventSourceFactory extends Factory
{
    protected $model = EventSource::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name_display = fake()->domainName();
        return [
            _::name_display => $name_display,
            _::name_display_short => $name_display,
            _::name_importer => fake()->sha256,
            _::event_source_data_type => EnumEventSourceDataType::SCRAPE,
            _::command_name => 'command_name',
            _::command_parameters => '-r -c', // recursive, clobber
            _::base_url => fake()->url(),
        ];
    }

    public function configure(): static
    {
        return $this->afterMaking(function () {
        })->afterCreating(function () {
        });
    }
}
