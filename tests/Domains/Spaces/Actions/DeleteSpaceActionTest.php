<?php
declare(strict_types=1);

namespace Tests\Domains\Spaces\Actions;

use App\Domains\Spaces\Actions\SpaceActionDelete;
use PHPUnit\Framework\TestCase;

// TODO: Implement
class DeleteSpaceActionTest extends TestCase
{
    // Delete Active Space
        // Space should not be deleted
        // Return HTTP error code

    // Delete Inactive Space
        // if user is space admin or staff admin
            // Space should be deleted
            // Return HTTP success code

    // Delete Inactive Space
        // if space has active events do not allow
}

