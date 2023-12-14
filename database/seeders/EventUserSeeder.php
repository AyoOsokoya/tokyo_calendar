<?php

namespace Database\Seeders;

use App\Domains\Events\Models\Event;
use App\Domains\Users\Enums\EnumUserEventAttendanceStatus;
use App\Domains\Users\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class EventUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private Collection $attendance_statuses;

    public function run(): void
    {
        $this->attendance_statuses = collect(EnumUserEventAttendanceStatus::cases());

        // Link users to events pseudo-randomly
        User::all()->each(function (User $user) {
            Event::all()->each(function (Event $event) use ($user) {
                $should_skip_event_for_linking_to_user = !(($event->id + $user->id) % 10);
                if ($should_skip_event_for_linking_to_user) {
                    return;
                }

                $user->events()->attach(
                    $event,
                    [
                        'user_event_attendance_status' => $this->attendance_statuses->random(),
                        'starts_at' => $event->starts_at,
                        'ends_at' => $event->starts_at->addHours(3)
                    ]
                );
            });
        });
    }
}
