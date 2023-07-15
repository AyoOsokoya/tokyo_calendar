<?php
declare(strict_types = 1);

namespace App\Enums;

enum EnumApiResponseFormat: string
{
    case JSON = 'json'; // me for if I create an event
    case ICAL = 'ical'; // events from external sources
}
