<?php
declare(strict_types = 1);

namespace App\Domains\Users\Enums;

enum EnumUserType: string
{
    case ADMIN = 'admin';
    case CREATOR = 'creator'; // creates large scale paid events
    case STANDARD = 'standard';
    case STAFF = 'staff';
}
