<?php
declare(strict_types = 1);

namespace App\Console\Commands;

use App\Domains\Events\Models\EventSource;
use App\Domains\Import\Actions\EventActionIngestEventArrayData;
use Illuminate\Console\Command;
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
    // protected $signature = 'app:import-events {import_date} {event_source} {events_json_file}';

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
            EventActionIngestEventArrayData::make($event_data, $event_source)->execute();
        });
    }
}
