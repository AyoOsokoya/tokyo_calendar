<?php

declare(strict_types=1);

namespace App\Domains\Events\Enums;

enum EnumEventCategories: string
{
    case ART = 'art';
    case BARS = 'bars';
    case BUSINESS = 'business';
    case CULTURAL = 'cultural';
    case DANCE = 'dance';
    case EDUCATIONAL = 'educational';
    case ENTERTAINMENT = 'entertainment';
    case FASHION = 'fashion';
    case FESTIVAL = 'festival';
    case FOOD = 'food';
    case KIDS = 'kids';
    case MISCELLANEOUS = 'miscellaneous'; // event doesn't have a tag
    case SPORTS = 'sports';
    case OUTDOORS = 'outdoors';
    case MUSIC = 'music';
    case PARTY = 'party';
    case SHOPPING = 'shopping';
}
