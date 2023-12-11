<?php
declare(strict_types=1);

namespace App\Domains\Spaces\Actions;

use App\Domains\Spaces\Models\Space;
use App\Domains\Users\Enums\EnumUserSpaceRoleType;
use App\Domains\Users\Models\User;

class SpaceActionCreate
{
    private array $space_data;
    private User $user;
    private function __construct($space, $user)
    {
        $this->space_data = $space;
        $this->user = $user;
    }

    public static function make(array $space, User $user)
    {
        return new SpaceActionCreate($space, $user);
    }

    public function execute(): void
    {
        $space = Space::create($this->space_data);

        $this->user->spaces()->attach(
            $space,
            [
                'user_space_role_type' => EnumUserSpaceRoleType::ADMIN,
            ]
        );
    }
}
