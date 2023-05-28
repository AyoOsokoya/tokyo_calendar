<?php
declare(strict_types = 1);

namespace App\Enums;

enum EnumUserType: string
{
    case ADMIN = 'admin'; // me for if I create an event
    case NORMAL = 'normal'; // events from external sources
}
