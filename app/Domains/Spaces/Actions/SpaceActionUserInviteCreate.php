<?php

declare(strict_types=1);

namespace App\Domains\Spaces\Actions;

use App\Domains\Spaces\Models\Space;
use App\Domains\Users\Enums\EnumUserSpaceInviteStatus;
use App\Domains\Users\Enums\EnumUserSpaceRoleType;
use App\Domains\Users\Models\Tables\TableUserSpace as US;
use App\Models\User;

class SpaceActionUserInviteCreate
{
    private Space $space;

    private User $user;

    private User $invited_user;

    private EnumUserSpaceInviteStatus $invite_status;

    private EnumUserSpaceRoleType $role_type;

    private function __construct($space, $user, $invited_user, $invite_status, $role_type)
    {
        $this->space = $space;
        $this->user = $user;
        $this->invited_user = $invited_user;
        $this->invite_status = $invite_status;
        $this->role_type = $role_type;
    }

    public static function make(
        array $space,
        User $user,
        User $invited_user,
        EnumUserSpaceInviteStatus $invite_status,
        EnumUserSpaceRoleType $role_type
    ): SpaceActionUserInviteCreate {
        return new SpaceActionUserInviteCreate($space, $user, $invited_user, $invite_status, $role_type);
    }

    public function execute()
    {
        if ($this->user->isSpaceAdmin($this->space) || $this->user->isSpaceStaff($this->space)) {
            $this->space->users()->attach(
                $this->invited_user->id,
                [
                    US::user_space_invite_status => $this->invite_status->value,
                    US::user_space_role_type => $this->role_type->value,
                ]
            );
        } else {
            throw new \Exception('You are not allowed to update this space.');
        }
    }
}
