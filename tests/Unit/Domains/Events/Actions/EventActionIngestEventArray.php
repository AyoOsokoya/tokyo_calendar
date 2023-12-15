<?php

declare(strict_types=1);

namespace Tests\Unit\Domains\Events\Actions;

use App\Domains\Events\Enums\EnumEventCategories;
use App\Domains\Events\Enums\EnumEventStatus;
use App\Domains\Events\Models\Event;
use App\Domains\Events\Models\EventSource;
use App\Domains\Import\Actions\EventActionIngestEventArrayData;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use PHPUnit\Framework\TestCase;

// EventActionIngestEventPreventDuplicatesTest
class EventActionIngestEventArray extends TestCase
{
    use RefreshDatabase;

    private EventSource $event_source;

    private array $event_data = [];

    public function setUp(): void
    {
        $this->event_source = EventSource::factory()->make();
        $this->event_data = [
            'name' => 'Test Event',
            'description' => 'Loreum Ipsum dolor sit amet',
            'longitude' => null,
            'latitude' => null,
            'address' => '',
            'starts_at' => Carbon::now(),
            'ends_at' => Carbon::now()->addHours(3),
            'event_status' => EnumEventStatus::ACTIVE,
            'event_category' => EnumEventCategories::ART,
            'url' => 'https://www.events.com/event/123',
            'url_image' => 'https://images.events.com/event/123.jpg',
            'event_source_id' => $this->event_source->id,
            'import_unique_id' => 'https://www.events.com/event/123@#1234567',
            'import_data_hash' => '',
        ];
    }

    public function testImportEvent()
    {
        $events_count_should_be_zero = Event::count();
        $this->assertEquals(
            0,
            $events_count_should_be_zero,
            'Events count should be 0 for an empty database'
        );

        EventActionIngestEventArrayData::make(
            $this->event_data,
            $this->event_source,
        )->execute();

        $events_count_should_be_one = Event::count();
        $this->assertEquals(
            1,
            $events_count_should_be_one,
            'Events count should be 1 after creating an event'
        );
    }

    public function testImportDuplicateEvents()
    {
        $duplicate_event_data = $this->event_data;

        EventActionIngestEventArrayData::make(
            $this->event_data,
            $this->event_source,
        )->execute();

        EventActionIngestEventArrayData::make(
            $duplicate_event_data,
            $this->event_source,
        )->execute();

        $events_count_should_be_one = Event::count();
        $this->assertEquals(
            1,
            $events_count_should_be_one,
            'Event duplication has been prevented.'
        );
    }

    public function testUpdateEvent()
    {
        $updated_event_data = $this->event_data;
        $update_event_name = 'Updated name for event';
        $updated_event_data['name'] = $update_event_name;

        $updated_event = EventActionIngestEventArrayData::make(
            $updated_event_data,
            $this->event_source,
        )->execute();

        $this->assertEquals(
            $update_event_name,
            $updated_event->name,
            'Event name updated'
        );

        $events_count_should_be_one = Event::count();
        $this->assertEquals(
            1,
            $events_count_should_be_one,
            'There should ony be one event after an the event is updated/'
        );
    }
}
