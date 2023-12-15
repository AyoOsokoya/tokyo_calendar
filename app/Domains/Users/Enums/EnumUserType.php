<?php

declare(strict_types=1);

namespace App\Domains\Users\Enums;

enum EnumUserType: string
{
    case ADMIN = 'admin';
    case STAFF = 'staff';
    case STANDARD = 'standard';
}
