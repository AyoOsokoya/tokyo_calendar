<?php
declare(strict_types = 1);

namespace App\Providers;

use App\Models\Event;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;
use Spatie\IcalendarGenerator\Components\Calendar as iCalCalendar;
use Spatie\IcalendarGenerator\Components\Event as iCalEvent;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Response::macro('jsonICalResponse', function($events){
            $extension = request()->route()->parameter('extension')
                ?? request()->header('accept')
                ?? 'ical';

            if (in_array($extension, ['ical', 'application/ical'])) {
                $events_array = [];
                foreach ($events as $event) {
                    /** @var Event $event */
                    $events_array []= iCalEvent::create(
                        "{$event->source->name_display_short}: $event->name"
                    )
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
            } else {
               return response()->json($events);
            }
        });
    }
}
