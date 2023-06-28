<?php
declare(strict_types = 1);

namespace App\Enums;

enum EnumUserEventAttendanceStatus: string
{
    case GOING = 'going'; // Definitely
    case MAYBE = 'maybe'; // just wanna be notified
    case NOT_INTERESTED = 'not_interested'; // Already got plans or just don't wanna go
    // Spatie iCal has a list of 5 https://github.com/spatie/icalendar-generator probably a good idea to use
    // this or integrate it in to mine
    /*
        There are five participation statuses:
        These should be passed to the calendar
        The current Enum should be used internally  or just used ParticiPationStatus
            going -> accepted
            maybe -> tentative
            not_interested -> declined

        ParticipationStatus::accepted()
        ParticipationStatus::declined()
        ParticipationStatus::tentative()
        ParticipationStatus::needs_action()
        ParticipationStatus::delegated()
    */
}
