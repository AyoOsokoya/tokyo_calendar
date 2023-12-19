<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Domains\Users\Enums\EnumUserRegistrationStatus;
use App\Domains\Users\Enums\EnumUserRoleType;
use App\Domains\Users\Models\Tables\TableUser as _;
use App\Domains\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * @extends Factory
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            _::name_first => fake()->firstName(),
            _::name_last => fake()->lastName(),
            _::name_middle => fake()->lastName(),
            _::name_handle => fake()->userName(),
            _::avatar => fake()->imageUrl(),
            _::date_of_birth => Carbon::now()->subYears(rand(12, 80)),
            _::user_role_type => EnumUserRoleType::STANDARD,
            _::email => fake()->unique()->safeEmail(),
            _::email_verified_at => now(),
            _::password => Str::random(32),
            _::remember_token => Str::random(10),
        ];
    }

    public function configure(): static
    {
        return $this->afterMaking(function () {
        })->afterCreating(function () {
        });
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            _::email_verified_at => null,
            _::account_status => EnumUserRegistrationStatus::UNVERIFIED,
        ]);
    }

    public function userType(EnumUserRoleType $user_type): static
    {
        return $this->state(fn (array $attributes) => [
            _::user_role_type => $user_type,
        ]);
    }
}
