<?php

declare(strict_types=1);

namespace App\Domains\Spaces\Actions;

// TODO: Implement
use App\Domains\Spaces\Models\Space;
use App\Domains\Users\Models\User;

class SpaceActionDelete
{
    private Space $space;

    private User $user;

    private function __construct($space, $user)
    {
        $this->space = $space;
        $this->user = $user;
    }

    public static function make(array $space, User $user)
    {
        return new SpaceActionDelete($space, $user);
    }

    public function execute(): void
    {
        // TODO: Use Policy and Gates
        // https://laravel.com/docs/10.x/authorization
        // if ($this->user->cannot('delete', $this->space)) {
        //     throw new \Exception('You are not allowed to delete this space.');
        // }

        if ($this->user->isSpaceAdmin($this->space)) {
            $this->space->users()->detach();
            $this->space->events()->delete();
            $this->space->delete();
        } else {
            throw new \Exception('You are not allowed to delete this space.');
        }

    }
}
