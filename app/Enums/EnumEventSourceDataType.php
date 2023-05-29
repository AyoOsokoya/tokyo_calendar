<?php

namespace App\Enums;

enum EnumEventSourceDataType: string
{
    case ICAL = 'ical';
    case MANUAL = 'manual';
    case RSS = 'rss';
    case SCRAPE = 'scraped';
}
