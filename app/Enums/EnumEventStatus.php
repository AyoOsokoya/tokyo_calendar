<?php
declare(strict_types = 1);

namespace App\Enums;

enum EnumEventStatus: string
{
    case ACTIVE = 'active'; // Event is currently planned and will happen 100%
    case CANCELLED = 'cancelled'; // Event was cancelled. Update calendar when it changes
    case TENTATIVE = 'tentative'; // ie: Might be cancelled due to weather.

}
