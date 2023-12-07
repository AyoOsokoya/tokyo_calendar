<?php
declare(strict_types=1);

namespace App\Domains\Users\Enums;

enum EnumUserRegistrationStatus: string
{
    case VERIFIED = 'verified';
    case UNVERIFIED = 'unverified';
}
