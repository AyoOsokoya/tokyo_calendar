<?php
declare(strict_types = 1);

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\EnumUserEventAttendanceStatus;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\EventSource;
use App\Models\Event;
use Illuminate\Support\Collection;

class DatabaseSeeder extends Seeder
{
    // private Collection $attendance_statuses;
    /**
     * Seed the application's database.
     */

    private Collection $attendance_statuses;

    public function run(): void
    {
        // TODO Extract to config directory
        $user_count = 5;
        $event_source_count = 10;
        $event_count = 100;

        User::factory()->count($user_count)->create();
        EventSource::factory()->count($event_source_count)->create();
        Event::factory()->count($event_count)->create();

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
                   ['user_event_attendance_status' => $this->attendance_statuses->random()]
               );
           });
       });
    }
}
