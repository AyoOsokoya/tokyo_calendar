<?php
declare(strict_types=1);

namespace App\Domains\Users\Enums;

enum EnumUserSpaceRoleType: string
{
    case OWNER = 'owner'; // admin of the space
    case ADMIN = 'admin'; // can edit the space & space events
    case FOLLOWER = 'follower'; // follower of the space
    case GUEST = 'guest'; // going to an event but does not belong
}
