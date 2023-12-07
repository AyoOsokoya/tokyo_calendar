<?php
declare(strict_types=1);

namespace App\Domains\Spaces\Enums;

enum EumnSpacePrivacyStatus: string
{
    case PUBLIC = 'public'; // anyone can see the event and join
    case PRIVATE = 'private'; // anyone can see the event, but only invited users can join
    case HIDDEN = 'hidden'; // unlisted
}
