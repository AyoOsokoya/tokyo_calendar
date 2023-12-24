<?php

declare(strict_types=1);

namespace App\Domains\Users\Actions;

use App\Domains\Events\Models\Event;
use App\Domains\Users\Enums\EnumUserEventAttendanceStatus;
use App\Models\User;

class UserActionEventAttendanceStatusCreate
{
    private User $user;

    private Event $event;

    private EnumUserEventAttendanceStatus $status;

    private function __construct(User $user, Event $event, EnumUserEventAttendanceStatus $status)
    {
        $this->user = $user;
        $this->event = $event;
        $this->status = $status;
    }

    public static function make(User $user, Event $event, EnumUserEventAttendanceStatus $status)
    {
        return new UserActionEventAttendanceStatusCreate($user, $event, $status);
    }

    public function execute(): void
    {
        $this->user->events()->attach(
            $this->event,
            [
                'user_event_attendance_status' => $this->status,
                'starts_at' => $this->event->starts_at,
                'ends_at' => $this->event->ends_at,
            ]
        );
    }
}
