<?php
declare(strict_types=1);

namespace App\Domains\Users\Enums;

enum EnumUserAccountType: string
{
    case PROFESSIONAL = 'professional';
    case PERSONAL = 'personal';

}
