<?php

declare(strict_types=1);

namespace Tests\Unit\Domains\Users\Models;

use App\Domains\Events\Models\Event;
use App\Domains\Spaces\Models\Space;
use App\Domains\Users\Models\User;
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
    }
}
