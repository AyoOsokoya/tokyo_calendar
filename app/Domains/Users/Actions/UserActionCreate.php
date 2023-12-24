<?php

declare(strict_types=1);

namespace App\Domains\Users\Actions;

use App\Domains\Users\Enums\EnumUserAccountType;
use App\Domains\Users\Enums\EnumUserActivityStatus;
use App\Domains\Users\Enums\EnumUserStaffRole;
use App\Domains\Users\Models\Tables\TableUser as u;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserActionCreate
{
    private array $user_data;

    private function __construct($user_data)
    {
        $this->user_data = $user_data;
    }

    public static function make(array $user_data): UserActionCreate
    {
        return new UserActionCreate($user_data);
    }

    public function execute(): User
    {
        // TODO: if Auth User is Admin, allow creation of any user type
        return User::create([
            u::name => $this->user_data['name'],
            u::email => $this->user_data['email'],
            u::handle => $this->user_data['handle'],
            u::password => Hash::make($this->user_data['password']),
            // u::avatar => $request->avatar,
            u::staff_role => EnumUserStaffRole::ADMIN,
            u::activity_status => EnumUserActivityStatus::ACTIVE,
            u::account_type => EnumUserAccountType::PROFESSIONAL,
        ]);
    }
}
