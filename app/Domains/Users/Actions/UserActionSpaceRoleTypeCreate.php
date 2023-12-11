<?php
declare(strict_types=1);

namespace App\Domains\Users\Actions;

use App\Domains\Spaces\Models\Space;
use App\Domains\Users\Enums\EnumUserSpaceRoleType;
use App\Domains\Users\Models\User;

class UserActionSpaceRoleTypeCreate
{
    private User $user;
    private Space $space;
    private EnumUserSpaceRoleType $role_type;

    private function __construct($user, $space, $role_type)
    {
        $this->user = $user;
        $this->space = $space;
        $this->role_type = $role_type;
    }

    public static function make(User $user, Space $space, EnumUserSpaceRoleType $role_type): UserActionSpaceRoleTypeCreate
    {
        return new UserActionSpaceRoleTypeCreate($user, $space, $role_type);
    }

    public function execute()
    {
        $this->user->spaces()->attach(
            $this->space,
            [
                'user_space_role_type' => $this->role_type->value,
            ]
        );
    }
}
