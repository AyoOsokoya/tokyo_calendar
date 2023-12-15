<?php

declare(strict_types=1);

namespace App\Domains\Users\Models\Tables;

class TableUser
{
    public const table_name = 'users';

    public const id = 'id';

    public const name_first = 'name_first';

    public const name_last = 'name_last';

    public const name_middle = 'name_middle';

    public const name_handle = 'name_handle';

    public const avatar = 'avatar';

    public const date_of_birth = 'date_of_birth';

    public const user_type = 'user_type';

    public const email = 'email';

    public const email_verified_at = 'email_verified_at';

    public const password = 'password';

    public const remember_token = 'remember_token';
}
