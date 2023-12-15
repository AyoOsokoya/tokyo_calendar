<?php

declare(strict_types=1);

namespace App\Domains\Users\Enums;

enum EnumUserSpaceInviteStatus: string
{
    case PENDING = 'pending'; // invite was sent but not yet accepted or declined
    case ACCEPTED = 'accepted'; // invite was accepted by the invitee
    case DECLINED = 'declined'; // invite was declined by the invitee
    case CANCELLED = 'cancelled'; // invite was cancelled by the inviter
}
