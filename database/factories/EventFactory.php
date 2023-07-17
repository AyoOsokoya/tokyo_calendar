<?php
declare(strict_types = 1);

namespace Database\Factories;

use App\Enums\EnumEventCategories;
use App\Enums\EnumEventStatus;
use App\Enums\EnumEventUserAttendanceStatus;
use App\Models\Event;
use App\Models\EventSource;
use App\Models\User;
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
        $eventStart = Carbon::now()->addDays(rand(1, 45));
        // Longer term, location GPS need to match the coordinates for better testing.
        $location = fake()->localCoordinates();

        $url = fake()->url();
        return [
            'name' => ucwords(fake()->words(4, true)),
            'description' => fake()->text(),
            'longitude' => $location['longitude'],
            'latitude' => $location['latitude'],
            'address' => fake()->address(),
            'starts_at' => $eventStart,
            'ends_at' => $eventStart->addHours(rand(1, 7)),
            'event_status' => EnumEventStatus::ACTIVE,
            'event_category' => collect(EnumEventCategories::cases())->random(),
            'event_source_id' => NULL,
            'import_unique_id' => md5($url . $eventStart->toString()),
            'import_data_hash' => ''
        ];
    }

    public function configure(): static
    {
        return $this->afterMaking(function (Event $event) {
            $event_sources = EventSource::all();
            /** @var EventSource $event_source */
            if ($event_sources->isNotEmpty()) {
                $event_source = $event_sources->random();
            } else {
                $event_source = EventSource::factory()->create();
            }

            $event->import_data_hash = $event->createImportDataHash();
            $event->event_source_id = $event_source->id;
            $event->save();
        });
    }

    public function withUser(): static
    {
        return $this->afterCreating(function (Event $event) {
           $user = User::factory()->create();

           $user->events()->attach(
               $event,
               ['user_event_attendance_status' => EnumEventUserAttendanceStatus::GOING]
           );
        });
    }
}
