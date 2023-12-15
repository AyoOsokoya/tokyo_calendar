<?php

declare(strict_types=1);

namespace App\Domains\Spaces\Enums;

enum EnumSpaceVerificationStatus: string
{
    case UNVERIFIED = 'unverified'; // space is not verified as being owned
    case PENDING = 'pending'; // space is in the process of being verified
    case VERIFIED = 'verified'; // space is verified as being owned
    case DISPUTED = 'disputed'; // space is disputed as being owned
    case REJECTED = 'rejected'; // space is rejected as being owned
}
