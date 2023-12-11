<?php
declare(strict_types=1);

namespace App\Domains\Spaces\Actions;

// TODO: Implement
use App\Domains\Spaces\Models\Space;
use App\Domains\Users\Models\User;

class SpaceActionUpdate
{
    private Space $space;
    private array $update;
    private User $user;

    private function __construct($space, $update, $user)
    {
        $this->space = $space;
        $this->user = $user;
        $this->update = $update;
    }

    public static function make(array $space, array $update, User $user)
    {
        return new SpaceActionUpdate($space, $update, $user);
    }

    public function execute()
    {
        if ($this->user->isSpaceAdmin($this->space)) {
            $this->space->update([
                'name' => $this->update['name'],
                'description' => $this->update['description'],
                'socials_json' => $this->update['socials_json'],
                'schedule_text' => $this->update['schedule_text'],
                'gallery_json' => $this->update['gallery_json'],
                'url' => $this->update['url'],
                'space_activity_status' => $this->update['space_activity_status'],
            ]);
        } else {
            throw new \Exception('You are not allowed to update this space.');
        }

    }
}
