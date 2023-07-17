<?php
declare(strict_types = 1);

namespace App\Domains\Events\Actions;

use App\Enums\EnumEventCategories;
use App\Enums\EnumEventStatus;
use App\Models\Event;
use App\Models\EventSource;
use Illuminate\Support\Carbon;

class ImportEventWithoutDuplicating
{
    private Event $import_event;
    private EventSource $event_source;

    private function __construct($import_event_data, EventSource $event_source)
    {
        $this->event_source = $event_source;
        $this->import_event = Event::make([
            'name' => $import_event_data['name'],
            'description' => $import_event_data['description'],
            'starts_at' => Carbon::parse($import_event_data['starts_at']),
            'ends_at' => Carbon::parse($import_event_data['ends_at']),
            'import_unique_id' => $import_event_data['unique_identifier'],
            'event_source_id' => $this->event_source->id,
            'event_category' => EnumEventCategories::MUSIC,
            'event_status' => EnumEventStatus::ACTIVE,
            'url' => $import_event_data['url'],
        ]);
    }

    public static function make(array $import_event_data, EventSource $event_source): ImportEventWithoutDuplicating
    {
        return new ImportEventWithoutDuplicating($import_event_data, $event_source);
    }

    public function execute(): void
    {
        $import_event_data_hash
            = CreateImportDataHashAction::make($this->import_event)->execute();
        $existing_event_in_database
            = Event::where('import_unique_id', $this->import_event->import_unique_id)->first();

        if ($existing_event_in_database) {
            if ($import_event_data_hash === $existing_event_in_database->import_data_hash) {
                return;
            } else {
                $this->import_event->id = $existing_event_in_database->id;
                $this->import_event->import_data_hash = $import_event_data_hash;
                $this->import_event->update();
                return;
            }
        }
        $this->createNewEvent();
    }

    private function createNewEvent(): void
    {
        $this->import_event->refresh();
        $this->import_event->import_data_hash
            = CreateImportDataHashAction::make($this->import_event)->execute();
        $this->import_event->save();
    }
}
