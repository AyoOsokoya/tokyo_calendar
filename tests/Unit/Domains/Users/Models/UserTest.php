<?php

declare(strict_types=1);

namespace Tests\Unit\Domains\Users\Models;

use App\Domains\Events\Models\Event;
use App\Domains\Location\Models\Location;
use App\Domains\Spaces\Models\Space;
use App\Domains\Users\Enums\EnumUserStaffRole;
use App\Domains\Users\Models\User;
use App\Domains\Users\Models\Tables\TableUser as _;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_user_factory_creation(): void
    {
        $spaces = Space::factory()
            ->count(10)
            ->create();

        $events = Event::factory()
            ->count(10)
            ->create();

        User::factory()
            //->withSpaces($spaces)
            ->withEvents($events)
            ->create();

        $this->assertTrue(true);
        $this->assertDatabaseCount('users', 1);
        $this->assertDatabaseCount('spaces', 10);
        $this->assertDatabaseCount('events', 10);

        // Create 10 spaces
            // create 10 events for each space

        // Create a default database
        // Users, Events, Spaces
        // User follows many spaces
            // is an admin, guest etc at a space
        // User follows many events
            // user has differing roles for event (admin, guest etc)
            // user has differing attendance status for event
            // user has differing role types for space?
                // User event role type does not depend on space usually
                    // TODO: think about the relationship between event roles and user event roles
            // Create one staff Admin (user 1)
            // Create one space admin for each space space 2 admin = user 2, space 3 admin = user 3 etc
            // Create 100 users who are just default users
                // follow PSEUDO random events and spaces (srand())
            // Follow 25 spaces each
            // Follow 25 events each
            // Follow 25 friends and make follow backs (do this in the specific test)

        // Can spaces follow other spaces ???

        // 100 users
        $staff_admin = User::factory()->state([
            _::name_first => 'Admin',
            _::name_middle => 'Test',
            _::name_last => 'User',
            _::name_handle => 'admin',
            _::email => 'admin@user.com',
            _::staff_role => EnumUserStaffRole::ADMIN->value,
        ])->create();

        $users = User::factory()->count(100)->create();
        $spaces = Space::factory()->count(10)->create();
        // 10 spaces
        // 15 events per space
            // some in the past
            // some in the future
            // some happening now
        // Users follow spaces
        $users->each(function (User $user) use ($spaces) {
            $user->spaces()->attach($spaces->random(25));
        });
        // users follow/attend events

        User::factory()->has(
            Space::factory()
                ->count(10)
                ->state(function (array $attributes, User $user) {
                    return ['user_id' => $user->id];
                })->has(
                    Event::factory()
                        ->count(10)
                        ->state(function (array $attributes, Space $space) {
                            return ['space_id' => $space->id];
                        })
                )
        )->create();
    }
}
