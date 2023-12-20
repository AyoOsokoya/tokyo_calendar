<?php

declare(strict_types=1);

namespace App\Domains\Users\Enums;

enum EnumUserActivityStatus: string
{
    case PENDING = 'pending';
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case SUSPENDED = 'suspended';
    case BANNED = 'banned';
}
