<?php
declare(strict_types=1);

namespace App\Domains\Spaces\Enums;

enum EnumSpaceInviteStatus: string
{
    case PENDING = 'pending'; // invite was sent but not yet accepted or declined
    case ACCEPTED = 'accepted'; // invite was accepted by the invitee
    case DECLINED = 'declined'; // invite was declined by the invitee
    case CANCELLED = 'cancelled'; // invite was cancelled by the inviter
}
