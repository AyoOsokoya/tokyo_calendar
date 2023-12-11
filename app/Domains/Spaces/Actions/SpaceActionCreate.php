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
        $space = Space::create([
           'name' => $this->space_data['name'],
            'description' => $this->space_data['description'],
            'socials_json' => $this->space_data['socials_json'],
            'schedule_text' => $this->space_data['schedule_text'],
            'gallery_json' => $this->space_data['gallery_json'],
            'url' => $this->space_data['url'],
            'space_activity_status' => $this->space_data['space_activity_status'],
        ]);

        $this->user->spaces()->attach(
            $space,
            [
                'user_space_role_type' => EnumUserSpaceRoleType::ADMIN,
            ]
        );
    }
}
