<?php

namespace App\Http\Controllers;

use App\Models\Event as Calendar;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Spatie\IcalendarGenerator\Components\Calendar as iCalCalendar;
use Spatie\IcalendarGenerator\Components\Event as iCalEvent;

class EventController extends BaseController
{
    // use AuthorizesRequests, ValidatesRequests;

    public function userEventsIcalFormat(): Response
    {
        $events_array = [];
        $events = Calendar::all();

        // TODO: move to action
        foreach ($events as $event) {
            /** @var Calendar $event */
            $events_array []= iCalEvent::create($event->name)
                ->startsAt($event->starts_at)
                ->endsAt($event->ends_at)
                ->description($event->description)
                ->coordinates($event->latitude, $event->longitude)
                ->url($event->url)
                ->address($event->address);
        }

        $calendar = iCalCalendar::create('My Events')
            ->event($events_array);

        return response($calendar->get())
            ->withHeaders([
                'Content-Type' => 'text/plain'
            ]);
    }
}
