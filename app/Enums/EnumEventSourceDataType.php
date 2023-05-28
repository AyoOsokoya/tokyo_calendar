<?php
declare(strict_types = 1);

namespace App\Enums;

enum EnumEventSourceDataType: string
{
    case ICAL = 'ical';
    case MANUAL = 'manual';
    case RSS = 'rss';
    case SCRAPE = 'scrape';
    case USER = 'user';
    case me = 'me';
}
