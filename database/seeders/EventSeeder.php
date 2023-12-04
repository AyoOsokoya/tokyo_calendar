<?php

namespace Database\Seeders;

use App\Domains\Events\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $event_count = 100;
        Event::factory()->count($event_count)->create();
    }
}
