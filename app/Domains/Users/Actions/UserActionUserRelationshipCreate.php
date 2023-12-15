<?php

declare(strict_types=1);

namespace App\Domains\Users\Actions;

use App\Domains\Users\Models\User;

class UserActionUserRelationshipCreate
{
    private array $user_data;

    private function __construct(array $user_data)
    {
        $this->user_data = $user_data;
    }

    public static function make(array $user_data)
    {
        return new UserActionUserRelationshipCreate($user_data);
    }

    public function execute()
    {
        User::create($this->user_data);
    }
}
