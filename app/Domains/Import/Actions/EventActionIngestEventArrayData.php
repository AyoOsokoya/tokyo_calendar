<?php

declare(strict_types=1);

namespace App\Domains\Import\Actions;

use App\Domains\Events\Enums\EnumEventCategories;
use App\Domains\Events\Enums\EnumEventStatus;
use App\Domains\Events\Models\Event;
use App\Domains\Events\Models\EventSource;
use Illuminate\Support\Carbon;

class EventActionIngestEventArrayData
{
    private Event $import_event;

    private EventSource $event_source;

    private function __construct(array $import_event_data, EventSource $event_source)
    {
        // TODO: Don't import or evaluate past events ?
        // TODO: Use a validator https://laravel.com/docs/10.x/validation#manually-creating-validators
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
            'url_image' => $import_event_data['image_url'],
        ]);
    }

    public static function make(array $import_event_data, EventSource $event_source): EventActionIngestEventArrayData
    {
        return new EventActionIngestEventArrayData($import_event_data, $event_source);
    }

    public function execute(): Event
    {
        // TODO: Could be EventActionFindIfAlreadyImported($this->import_event) : Event|null
        $import_event_data_hash
            = EventActionCreateImportDataHash::make($this->import_event)->execute();
        $existing_event_in_database
            = Event::where('import_unique_id', $this->import_event->import_unique_id)->first();

        // TODO: EventActionSaveOrUpdateEvent(Event $existing_event, Event $new_event): void
        if ($existing_event_in_database) {
            if ($import_event_data_hash === $existing_event_in_database->import_data_hash) {
                // Event exists and the remote data is the same
                return $existing_event_in_database;
            } else {
                // Event exists but the imported data is different (updated)
                $this->import_event->id = $existing_event_in_database->id;
                $this->import_event->import_data_hash = $import_event_data_hash;
                $this->import_event->update();
                $this->import_event->refresh();

                return $this->import_event;
            }
        }

        return $this->createNewEvent();
    }

    private function createNewEvent(): Event
    {
        $this->import_event->refresh();
        $this->import_event->import_data_hash
            = EventActionCreateImportDataHash::make($this->import_event)->execute();
        $this->import_event->save();
        $this->import_event->refresh();

        return $this->import_event;
    }
}
