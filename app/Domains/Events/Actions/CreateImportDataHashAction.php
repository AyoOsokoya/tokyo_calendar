<?php
declare(strict_types = 1);

namespace App\Domains\Events\Actions;

use App\Models\Event;

class CreateImportDataHashAction
{
    private Event $event;

    private function __construct(Event $event)
    {
        $this->event = $event;
    }

    public static function make(Event $event): CreateImportDataHashAction
    {
        return new CreateImportDataHashAction($event);
    }

    public function execute(): string
    {
        return md5(
            $this->event->name
            . $this->event->description
            . $this->event->event_status->value
            . $this->event->starts_at->toString()
            . $this->event->ends_at->toString()
        );
    }
}
