<?php

declare(strict_types=1);

namespace App\Domains\Users\Enums;

enum EnumUserRelationshipStatus: string
{
    case FOLLOW = 'FOLLOW';
    case UNFOLLOW = 'UNFOLLOW';
    case MUTUAL_FOLLOW = 'MUTUAL_FOLLOW';
}
