<?php

declare(strict_types=1);

namespace App\Domains\Users\Models\Tables;

class TableUser
{
    public const table_name = 'users';

    public const id = 'id';

    public const name = 'name';

    public const handle = 'name_handle';

    public const avatar = 'avatar';

    public const date_of_birth = 'date_of_birth';

    public const email = 'email';

    public const staff_role = 'staff_role';

    public const activity_status = 'activity_status';

    public const account_type = 'account_type';

    public const email_verified_at = 'email_verified_at';

    public const password = 'password';

    public const remember_token = 'remember_token';
}
