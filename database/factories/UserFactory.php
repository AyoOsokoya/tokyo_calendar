<?php
declare(strict_types = 1);

namespace Database\Factories;

use App\Domains\Users\Enums\EnumUserType;
use App\Models\User;
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
            'name_first' => fake()->firstName(),
            'name_last' => fake()->lastName(),
            'name_middle' => fake()->firstName(),
            'name_handle' => fake()->userName(),
            'date_of_birth' => Carbon::now()->subYears(rand(12, 80)),
            'user_type' => EnumUserType::guest,
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Str::random(32),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
