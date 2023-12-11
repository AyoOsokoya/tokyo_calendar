<?php
declare(strict_types=1);

namespace App\Domains\Events\Actions;

// TODO: Implement
use App\Domains\Events\Models\Event;

class EventActionCreate
{
    private array $event_data;

    private function __construct(array $event_data)
    {
        $this->event_data = $event_data;
    }

    public static function make(array $event_data)
    {
        return new EventActionCreate($event_data);
    }

    public function execute()
    {
        Event::create($this->event_data);
    }
}
