<?php
declare(strict_types = 1);

namespace Tests\Domains\Events\Actions;

use App\Domains\Events\Actions\ImportEventWithoutDuplicating;
use App\Enums\EnumEventCategories;
use App\Enums\EnumEventStatus;
use App\Models\Event;
use App\Models\EventSource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use PHPUnit\Framework\TestCase;

class ImportEventWithoutDuplicatingTest extends TestCase
{
    use RefreshDatabase;

    private EventSource $event_source;
    private array $event_data = [];

    function setUp(): void
    {
        $this->event_source = EventSource::factory()->make();
        $this->event_data = [
            'name' => 'Test Event',
            'description' => 'Loreum Ipsum dolor sit amet',
            'starts_at' => Carbon::now(),
            'ends_at' => Carbon::now()->addHours(3),
            'import_unique_id' => 'https://www.events.com/event/123@#1234567',
            'event_source_id' => $this->event_source->id,
            'event_category' => EnumEventCategories::ART,
            'event_status' => EnumEventStatus::ACTIVE,
            'url' => 'https://www.events.com/event/123'
        ];
    }

    function testImportEvent()
    {
        $events_count_should_be_zero = Event::count();
        $this->assertEquals(
            0,
            $events_count_should_be_zero,
            "Events count should be 0 for an empty database"
        );

        ImportEventWithoutDuplicating::make(
            $this->event_data,
            $this->event_source,
        )->execute();

        $events_count_should_be_one = Event::count();
        $this->assertEquals(
            1,
            $events_count_should_be_one,
            "Events count should be 1 after creating an event"
        );
    }

    function testImportDuplicateEvents()
    {
        $duplicate_event_data = $this->event_data;

        ImportEventWithoutDuplicating::make(
            $this->event_data,
            $this->event_source,
        )->execute();

        ImportEventWithoutDuplicating::make(
            $duplicate_event_data,
            $this->event_source,
        )->execute();

        $events_count_should_be_one = Event::count();
        $this->assertEquals(
            1,
            $events_count_should_be_one,
            "Event duplication has been prevented."
        );
    }

    function testUpdateEvent()
    {
        $updated_event_data = $this->event_data;
        $update_event_name = 'Updated name for event';
        $updated_event_data['name'] = $update_event_name;

        $updated_event = ImportEventWithoutDuplicating::make(
            $updated_event_data,
            $this->event_source,
        )->execute();

        $this->assertEquals(
            $update_event_name,
            $updated_event->name,
            "Event name updated"
        );

        $events_count_should_be_one = Event::count();
        $this->assertEquals(
            1,
            $events_count_should_be_one,
            "There should ony be one event after an the event is updated/"
        );
    }
}
