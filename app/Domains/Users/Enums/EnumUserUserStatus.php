<?php

declare(strict_types=1);

namespace App\Domains\Users\Enums;

enum EnumUserUserStatus: string
{
    case FOLLOW = 'FOLLOW';
    case UNFOLLOW = 'UNFOLLOW';
    case MUTUAL_FOLLOW = 'MUTUAL_FOLLOW';

    // FOLLOW, UNFOLLOW // later BLOCKED, MUTUAL, MUTED
    // These should probably be separate columns in the user_relationship_to_user table
}
