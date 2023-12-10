<?php
declare(strict_types=1);

namespace App\Domains\Spaces\Enums;

enum EnumSpaceActivityStatus: string
{
    case ACTIVE = 'active'; // space is open for business
    case INACTIVE = 'inactive'; // space is closed for the forseeable future
    case BANNED = 'banned'; // space has done something against the rules
    case DELETED = 'deleted'; // space is deleted
    case UNVERIFIED = 'unverified'; // space is not verified as being owned
    case STARTING = 'starting'; // space is in the process of being created
}
