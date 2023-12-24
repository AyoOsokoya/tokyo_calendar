<?php

declare(strict_types=1);

namespace Tests\Unit\Domains\Users\Models;

use App\Domains\Events\Models\Event;
use App\Domains\Spaces\Models\Space;
use App\Domains\Users\Enums\EnumUserEventAttendanceStatus;
use App\Domains\Users\Enums\EnumUserEventRoleType;
use App\Domains\Users\Enums\EnumUserSpaceInviteStatus;
use App\Domains\Users\Enums\EnumUserSpaceRoleType;
use App\Domains\Users\Enums\EnumUserStaffRole;
use App\Domains\Users\Models\Tables\TableUser as _;
use App\Domains\Users\Models\Tables\TableUserEvent as ue;
use App\Domains\Users\Models\Tables\TableUserSpace as us;
use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_create_user_and_relationships(): void
    {
        $user = User::factory()
            ->hasAttached(Space::factory()->count(10), [
                us::user_space_role_type => EnumUserSpaceRoleType::ADMIN,
                us::user_space_invite_status => EnumUserSpaceInviteStatus::ACCEPTED,
            ])
            ->hasAttached(Event::factory()->count(10), [
                ue::user_event_role_type => EnumUserEventRoleType::ADMIN,
                ue::user_event_attendance_status => EnumUserEventAttendanceStatus::GOING,
                // TODO: ue::inviter_id => $user->id, // user is self inviter
            ])
            ->create();

        // Assert relationships
        // Assert user has 10 spaces
        // Assert user has 10 events
        // Add
    }

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

        $staff_admin = User::factory()->state([
            _::name => 'Admin',
            _::handle => 'admin',
            _::email => 'admin@user.com',
            _::staff_role => EnumUserStaffRole::ADMIN->value,
        ])->create();
    }

    // Create user
    // update user
    // validation
    // update by other user?/admin
    // Add user to space
    // Change role in space
    // User relationships to others
    // follow user
    // follow back
    // User role to events
    // staff role type
    // user event role type
    // follow event
    // invite friends
}
