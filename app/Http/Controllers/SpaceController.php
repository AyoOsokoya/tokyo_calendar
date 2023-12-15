<?php

namespace App\Http\Controllers;

class SpaceController extends Controller
{
    public function space(): void
    {
        // check privacy and auth
        // return space data if exist
    }

    public function createSpace(): void
    {
        // Validate Data
        // return appropriate error if validation fails
        // Save
        // return appropriate error if save fails
        // Return OK status code
    }

    public function updateSpace(): void
    {
        // Validate Data
        // return appropriate error if validation fails
        // Update
        // return appropriate error if save fails
        // Return OK status code
    }

    public function deleteSpace(): void
    {
        // Check permissions
        // self delete or admin delete is okay
        // return appropriate error if delete fails
        // Return OK status code
    }

    public function followSpace(): void
    {
    }

    public function unfollowSpace(): void
    {
    }
}
