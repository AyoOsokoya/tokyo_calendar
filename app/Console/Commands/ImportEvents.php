<?php

namespace App\Console\Commands;

use App\Enums\EnumEventCategories;
use App\Enums\EnumEventStatus;
use App\Models\Event;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
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
    public function handle()
    {
        //
        // $event_source = $this->argument('event_source');
        // $data_file = $this->argument('event_source');


        // $import = Storage::get('events/this_year_billboard_events.json');
        $import = Storage::get('events/bluenote.json');
        $event_data_all = collect(json_decode($import, true));
        $event_data_all->each(function ($event_data) {
            /** @var Event $event */
            $event = Event::make([
                'name' => $event_data['name'],
                'description' => $event_data['description'],
                'starts_at' => Carbon::parse($event_data['starts_at']),
                'ends_at' => Carbon::parse($event_data['ends_at']),
                'import_unique_id' => $event_data['unique_identifier'],
                // 'event_source_id' => 1,
                'event_source_id' => 2,
                'event_category' => EnumEventCategories::MUSIC,
                'event_status' => EnumEventStatus::ACTIVE,
                'url' => $event_data['url'],
            ]);

            $event->refresh();
            $event->import_data_hash = $event->createImportDataHash();
            $event->save();
        });
        // open file
        // for each event
            // Validator
                // check the event data is valid
            // or log invalid event to a new file
            // Call ChatGPT ???
            // event_create
        // move the import file to an archive

    }
}
