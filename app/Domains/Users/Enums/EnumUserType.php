<?php
declare(strict_types = 1);

namespace App\Domains\Users\Enums;

enum EnumUserType: string
{
    case CREATOR = 'creator';
    case GUEST = 'guest';
}
