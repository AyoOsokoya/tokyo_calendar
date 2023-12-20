<?php

declare(strict_types=1);

namespace App\Domains\Users\Enums;

enum EnumUserStaffRole: string
{
    case ADMIN = 'admin';
    case STAFF = 'staff';
    case NONE = 'none';
}
