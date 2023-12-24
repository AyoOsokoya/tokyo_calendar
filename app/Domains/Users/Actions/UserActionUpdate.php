<?php

declare(strict_types=1);

namespace App\Domains\Users\Actions;

use App\Models\User;

class UserActionUpdate
{
    private User $acting_user;

    private array $user_data;

    private function __construct($acting_user, $user_data)
    {
        $this->acting_user = $acting_user;
        $this->user_data = $user_data;
    }

    public static function make(User $acting_user, array $user_data): UserActionUpdate
    {
        return new UserActionUpdate($acting_user, $user_data);
    }

    public function execute(): void
    {
        $this->acting_user->update($this->user_data);
    }
}
