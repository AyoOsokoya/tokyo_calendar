<?php
declare(strict_types=1);

namespace App\Domains\Spaces\Actions;

use App\Domains\Spaces\Models\Space;
use App\Domains\Users\Enums\EnumUserSpaceRoleType;
use App\Domains\Users\Models\User;

class SpaceActionCreate
{
    private array $space;
    private User $user;
    private function __construct($space, $user)
    {
        $this->space = $space;
        $this->user = $user;
    }

    public static function make(array $space, User $user)
    {
        return new SpaceActionCreate($space, $user);
    }

    public function execute(): void
    {
        $space = Space::create([
           'name' => $this->space['name'],
            'description' => $this->space['description'],
            'socials_json' => $this->space['socials_json'],
            'schedule_text' => $this->space['schedule_text'],
            'gallery_json' => $this->space['gallery_json'],
            'url' => $this->space['url'],
            'space_activity_status' => $this->space['space_activity_status'],
        ]);

        $this->user->spaces()->attach(
            $space,
            [
                'user_space_role_type' => EnumUserSpaceRoleType::ADMIN,
            ]
        );
    }
}
