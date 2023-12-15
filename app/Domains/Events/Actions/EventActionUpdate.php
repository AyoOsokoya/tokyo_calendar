<?php

declare(strict_types=1);

namespace App\Domains\Events\Actions;

// TODO: Implement
use App\Domains\Events\Models\Event;

class EventActionUpdate
{
    private Event $event;

    private array $event_data;

    private function __construct(Event $event, array $event_data)
    {
        $this->event = $event;
        $this->event_data = $event_data;
    }

    public static function make(Event $event, array $event_data)
    {
        return new EventActionUpdate($event, $event_data);
    }

    public function execute()
    {
        $this->event->update($this->event_data);
    }
}
