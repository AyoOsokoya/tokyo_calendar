<?php

declare(strict_types=1);

namespace App\Domains\Users\Actions;

use App\Domains\Users\Models\User;

class UserActionUpdate
{
    private User $user;

    private array $user_data;

    private function __construct($user, $user_data)
    {
        $this->user = $user;
        $this->user_data = $user_data;
    }

    public static function make(User $user, array $user_data): UserActionUpdate
    {
        return new UserActionUpdate($user, $user_data);
    }

    public function execute(): void
    {
        $this->user->update($this->user_data);
    }
}
