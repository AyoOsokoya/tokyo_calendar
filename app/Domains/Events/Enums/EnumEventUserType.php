<?php
declare(strict_types = 1);

namespace App\Domains\Events\Enums;

enum EnumEventUserType: string
{
    case ATTENDEE = 'attendee';
    case CREATOR = 'creator';

}
