<?php
declare(strict_types=1);

namespace App\Domains\Spaces\Enums;

enum EnumSpaceActivityStatus: string
{
    case ACTIVE = 'active'; // space is open for business
    case INACTIVE = 'inactive'; // space is closed for the forseeable future
}
