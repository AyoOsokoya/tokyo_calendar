<?php

declare(strict_types=1);

namespace App\Domains\Users\Actions;

use App\Domains\Users\Models\User;

class UserActionDelete
{
    private User $user;

    private function __construct($user)
    {
        $this->user = $user;
    }

    public static function make(User $user): UserActionDelete
    {
        return new UserActionDelete($user);
    }

    public function execute(): void
    {
        $this->user->events()->detach();
        $this->user->spaces()->detach();
        $this->user->relatedUsers()->detach();
        $this->user->deleteOrFail();
    }
}
