<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Domains\Events\Enums\EnumEventCategories;
use App\Domains\Events\Enums\EnumEventStatus;
use App\Domains\Events\Models\Event;
use App\Domains\Events\Models\EventSource;
use App\Domains\Events\Models\Tables\TableEvent as _;
use App\Domains\Import\Actions\EventActionCreateImportDataHash;
use App\Domains\Users\Enums\EnumUserEventAttendanceStatus;
use App\Domains\Users\Models\Tables\TableUserEvent as UE;
use App\Domains\Users\Models\User;
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
        $event_start = Carbon::now()->addDays(rand(1, 45));

        $url = fake()->url();

        return [
            _::name => ucwords(fake()->words(4, true)),
            _::description => fake()->text(),
            _::space_id => null,

            _::starts_at => $event_start,
            _::ends_at => $event_start->addHours(rand(1, 7)),

            _::event_status => EnumEventStatus::ACTIVE,
            _::event_category => collect(EnumEventCategories::cases())->random(),
            _::gallery_json => json_encode([
                fake()->imageUrl(),
                fake()->imageUrl(),
                fake()->imageUrl(),
                fake()->imageUrl(),
                fake()->imageUrl(),
            ]),

            _::url_cover_image => fake()->imageUrl(),
            _::url => $url,

            _::event_source_id => null,
            _::import_unique_id => md5($url.$event_start->toString()),
            _::import_data_hash => '',
        ];
    }

    public function configure(): static
    {
        return $this->afterMaking(function (Event $event) {
            $event_sources = EventSource::all();
            if ($event_sources->isNotEmpty()) { /** @var EventSource $event_source */
                $event_source = $event_sources->random();
            } else {
                $event_source = EventSource::factory()->create();
            }

            $event->import_data_hash = EventActionCreateImportDataHash::make($event)->execute();
            $event->event_source_id = $event_source->id;
            $event->save();
        })->afterCreating(function () {
        });
    }

    public function withUser(): static
    {
        return $this->afterCreating(function (Event $event) {
            $user = User::factory()->create();

            $user->events()->attach(
                $event,
                [UE::user_event_attendance_status => EnumUserEventAttendanceStatus::GOING]
            );
        });
    }
}
