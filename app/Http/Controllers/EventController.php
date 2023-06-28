<?php
declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;
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
        $events = Event::whereDate('starts_at', '>=', Carbon::now())
            ->with('source')
            ->get();

        foreach ($events as $event) {
            /** @var Event $event */
             $events_array []= iCalEvent::create( "{$event->source->name_display}: $event->name")
                ->startsAt($event->starts_at)
                ->endsAt($event->ends_at)
                ->uniqueIdentifier(md5($event->import_unique_id))
                ->description($event->description)
                // ->coordinates($event->latitude, $event->longitude)
                // ->address($event->address)
                ->url($event->url);
        }

        $calendar = iCalCalendar::create('My Events')
            ->event($events_array);

        return response($calendar->get())
            ->withHeaders([
                'Content-Type' => 'text/plain'
            ]);
    }
}
