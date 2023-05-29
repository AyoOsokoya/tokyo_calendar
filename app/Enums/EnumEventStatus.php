<?php

namespace App\Enums;

enum EnumEventStatus: string
{
    case OPEN = 'open';
    case CANCELLED = 'cancelled';
    case STARTED = 'started';
    case FINISHED = 'finished';
    case IN_PROGRESS = 'in progress';
}
