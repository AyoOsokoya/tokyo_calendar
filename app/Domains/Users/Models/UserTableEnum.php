<?php
declare(strict_types=1);

namespace App\Domains\Users\Models;

enum UserTableEnum: string
{
    case table = 'users';
    case id = 'id';
    case name_first = 'name_first';
    case name_last = 'name_last';
    case name_middle = 'name_middle';
    case name_handle = 'name_handle';
    case avatar = 'avatar';
    case date_of_birth = 'date_of_birth';
    case user_type = 'user_type';
    case email = 'email';
    case email_verified_at = 'email_verified_at';
    case password = 'password';
    case remember_token = 'remember_token';
}
