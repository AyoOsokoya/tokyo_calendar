<?php

namespace App\Console\Commands;

use App\Enums\EnumEventCategories;
use App\Enums\EnumEventStatus;
use App\Models\Event;
use App\Models\EventSource;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class ImportEvents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-events';
    // protected $signature = 'app:import-events {event_source} {events_json_file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import JSON event files from directory';

    /**
     * Execute the console command.
     */
    // Dates will be store under $(date '+%Y-%m-%d') for daily? imports
    public function handle()
    {
        $event_sources = collect([
            ['id' => 1, 'name' => 'this_year_billboard_events.json'],
            ['id' => 2, 'name' => 'bluenote.json'],
            ['id' => 3, 'name' => 'metropolis.json']
        ]);

        $event_sources->each(function ($event_source) {
            $import = Storage::get('events/' . $event_source['name']);
            $event_data_all = collect(json_decode($import, true));
            $event_source = EventSource::find($event_source['id']);
            $this->import_events($event_data_all, $event_source);
        });
    }

    public function import_events(Collection $events_data, EventSource $event_source): void
    {
        $events_data->each(function ($event_data) use ($event_source) {
            /** @var Event $import_event */
            $import_event = Event::make([
                'name' => $event_data['name'],
                'description' => $event_data['description'],
                'starts_at' => Carbon::parse($event_data['starts_at']),
                'ends_at' => Carbon::parse($event_data['ends_at']),
                'import_unique_id' => $event_data['unique_identifier'],
                'event_source_id' => $event_source->id,
                'event_category' => EnumEventCategories::MUSIC,
                'event_status' => EnumEventStatus::ACTIVE,
                'url' => $event_data['url'],
            ]);

            $event_already_exists = Event::where('import_unique_id', $import_event->import_unique_id)->first();
            if ($event_already_exists) {
                if ($import_event->createImportDataHash() === $event_already_exists->createImportDataHash()) {
                    // echo "Event hash matches \n";
                    return;
                }
                else {
                    // update event
                    echo "Updated\n";
                    $import_event->id = $event_already_exists->id;
                    $import_event->import_data_hash = $import_event->createImportDataHash();
                    $import_event->update();
                    return;
                }
            }
            // Create new event
            $import_event->refresh();
            $import_event->import_data_hash = $import_event->createImportDataHash();
            $import_event->save();
        });
    }
}
