<?php
declare(strict_types=1);

namespace App\Domains\Spaces\Actions;

// TODO: Implement
use App\Domains\Spaces\Models\Space;
use App\Domains\Users\Models\User;

class SpaceActionUpdate
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
        return new SpaceActionUpdate($space, $user);
    }

    public function execute()
    {
    }
}
