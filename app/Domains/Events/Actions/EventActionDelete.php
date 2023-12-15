<?php

declare(strict_types=1);

namespace App\Domains\Events\Actions;

// TODO: Implement
use App\Domains\Events\Models\Event;

class EventActionDelete
{
    private Event $event;

    private function __construct($event)
    {
        $this->event = $event;
    }

    public static function make(Event $event)
    {
        return new EventActionDelete($event);
    }

    public function execute()
    {
        // should we check who can delete here?
        $this->event->space()->detach(); // soft delete?
        $this->event->users()->detach(); // soft delete?
        $this->event->delete();
    }
}
