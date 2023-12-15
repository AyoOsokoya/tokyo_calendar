<?php

declare(strict_types=1);

namespace App\Domains\Users\Enums;

enum EnumUserSpaceRoleType: string
{
    case ADMIN = 'admin'; // can edit the space & space events
    case STAFF = 'staff'; // admin of the space
    case FOLLOWER = 'follower'; // follower of the space
    case GUEST = 'guest'; // going to an event but does not belong
}
