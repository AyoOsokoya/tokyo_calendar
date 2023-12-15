<?php
declare(strict_types=1);

namespace App\Domains\Users\Models\Tables;

class TableUserSpace
{
    const table_name = 'user_spaces';

    const id = 'id';
    const user_id = 'user_id';
    const space_id = 'space_id';
    const user_space_role_type = 'user_space_role_type';
    const user_space_invite_status = 'user_space_status';
}
