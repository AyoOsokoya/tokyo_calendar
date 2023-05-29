<?php

namespace App\Enums;

enum EnumUserType: string
{
    case ADMIN = 'admin';
    case NORMAL = 'normal';
    case CREATOR = 'creator';
}
