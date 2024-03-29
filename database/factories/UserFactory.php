<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Domains\Users\Enums\EnumUserAccountType;
use App\Domains\Users\Enums\EnumUserActivityStatus;
use App\Domains\Users\Enums\EnumUserEventAttendanceStatus;
use App\Domains\Users\Enums\EnumUserEventRoleType;
use App\Domains\Users\Enums\EnumUserRegistrationStatus;
use App\Domains\Users\Enums\EnumUserSpaceInviteStatus;
use App\Domains\Users\Enums\EnumUserSpaceRoleType;
use App\Domains\Users\Enums\EnumUserStaffRole;
use App\Domains\Users\Models\Tables\TableUser as _;
use App\Domains\Users\Models\Tables\TableUserEvent as ue;
use App\Domains\Users\Models\Tables\TableUserSpace as us;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            _::name => fake()->name(),
            _::handle => fake()->userName(),
            _::date_of_birth => fake()->date(),
            _::email => fake()->unique()->safeEmail(),
            _::account_type => EnumUserAccountType::PERSONAL,
            _::staff_role => EnumUserStaffRole::NONE,
            _::email_verified_at => now(),
            _::activity_status => EnumUserActivityStatus::ACTIVE,
            _::password => static::$password ??= Hash::make('password'),
            _::remember_token => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            _::email_verified_at => null,
            _::activity_status => EnumUserRegistrationStatus::UNVERIFIED,
        ]);
    }

    public function roleType(EnumUserStaffRole $user_type): static
    {
        return $this->state(fn (array $attributes) => [
            _::staff_role => $user_type,
        ]);
    }

    public function withSpaces(Collection $spaces): static
    {
        return $this->afterCreating(function (User $user) use ($spaces) {
            $spaces->each(function ($space) use ($user) {
                // TODO: use an action
                $space->users()->attach($user->id, [
                    us::user_space_role_type => EnumUserSpaceRoleType::ADMIN,
                    us::user_space_invite_status => EnumUserSpaceInviteStatus::ACCEPTED,
                ]);
            });
        });
    }

    public function withEvents(Collection $events): static
    {
        return $this->afterCreating(function (User $user) use ($events) {
            $events->each(function ($event) use ($user) {
                $event->users()->attach($user->id, [
                    ue::user_event_role_type => EnumUserEventRoleType::ADMIN,
                    ue::user_event_attendance_status => EnumUserEventAttendanceStatus::GOING,
                    ue::inviter_id => $user->id, // user is self inviter
                ]);
            });
        });
    }
}
