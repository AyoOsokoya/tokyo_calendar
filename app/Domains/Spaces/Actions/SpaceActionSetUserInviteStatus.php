<?php
declare(strict_types=1);

namespace App\Domains\Spaces\Actions;

// TODO: Implement
use App\Domains\Spaces\Enums\EnumSpaceInviteStatus;
use App\Domains\Spaces\Models\Space;
use App\Domains\Users\Models\User;

class SpaceActionSetUserInviteStatus
{
    private Space $space;
    private User $user;
    private User $invited_user;
    Private EnumSpaceInviteStatus $invite_status;

    private function __construct($space, $user, $invited_user, $status)
    {
        $this->space = $space;
        $this->user = $user;
        $this->invited_user = $invited_user;
        $this->invite_status = $status;
    }

    public static function make(
        array $space,
        User $user,
        User $invited_user,
        EnumSpaceInviteStatus $invite_status
    ): SpaceActionSetUserInviteStatus
    {
        return new SpaceActionSetUserInviteStatus($space, $user, $invited_user, $invite_status);
    }

    public function execute()
    {
        // If user can invite user to space
            // do invite
        // TODO: Decide if to use an enum for invite status and have a single action for setting it
    }
}
