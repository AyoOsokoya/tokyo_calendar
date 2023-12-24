<?php

declare(strict_types=1);

namespace App\Domains\Users\Actions;

use App\Models\User;

class UserActionCreate
{
    private array $user_data;

    private function __construct($user_data)
    {
        $this->user_data = $user_data;
    }

    public static function make(array $user_data): UserActionCreate
    {
        return new UserActionCreate($user_data);
    }

    public function execute()
    {
        User::create($this->user_data);
    }
}
