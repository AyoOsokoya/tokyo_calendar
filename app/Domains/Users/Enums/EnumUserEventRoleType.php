<?php

declare(strict_types=1);

namespace App\Domains\Users\Enums;

enum EnumUserEventRoleType: string
{
    case ADMIN = 'admin';
    case GUEST = 'guest';
}
