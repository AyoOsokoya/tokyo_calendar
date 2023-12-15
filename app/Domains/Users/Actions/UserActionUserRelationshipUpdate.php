<?php

declare(strict_types=1);

namespace App\Domains\Users\Actions;

// TODO: Implement
use App\Domains\Users\Models\User;

class UserActionUserRelationshipUpdate
{
    private array $user_data;

    private User $user;

    private function __construct(User $user, array $user_data)
    {
        $this->user = $user;
        $this->user_data = $user_data;
    }

    public static function make(User $user, array $user_data)
    {
        return new UserActionUserRelationshipUpdate($user, $user_data);
    }

    public function execute()
    {
        $this->user->update($this->user_data);
    }
}
