<?php
declare(strict_types = 1);

namespace App\Enums;

enum EnumEventSourceDataType: string
{
    case API = 'api'; // The provider has an api
    case ICAL = 'ical'; // provider supports ical
    case MANUAL = 'manual'; // manual entry through the database or a UI
    case RSS = 'rss'; // provider supports rss
    case SCRAPE = 'scrape';
    case USER = 'user';
}
