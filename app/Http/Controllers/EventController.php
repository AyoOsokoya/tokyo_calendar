<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use app\Models\Event;
use PhpParser\Node\Scalar\String_;
use Spatie\IcalendarGenerator\Components\Calendar as iCalCalendar;
use Spatie\IcalendarGenerator\Components\Event as iCalEvent;
use Illuminate\Support\Carbon;

class EventController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function userEventIcalFormat(): string
    {
        // use a closure
        $events = Event::all();
        $export = '';

        forEach($events as $event)
        {
            /** @var Event $event  */
            // TODO: https://github.com/spatie/icalendar-generator
            // TODO: CalDav research
            // TODO: Add Khronogram Account to iPhone like mail notes and calendars etc
                // Or Passworded iCal
                // https://support.apple.com/guide/iphone/set-up-mail-contacts-and-calendar-accounts-ipha0d932e96/ios

            $export .= iCalCalendar::create("KhronoGram Events")
                ->event(iCalEvent::create($event->name)
                    ->startsAt($event->starts_at)
                    ->endsAt($event->ends_at)
                )
                ->get();
        }

        return $export;
    }

    public function userEventsJsonFormat(): string
    {
        return json_encode(Event::all());
    }
}
