<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(): void
    {
    }

    public function logout(): void
    {
    }

    public function user(): void
    {
        // return user data
    }

    public function createUser(): void
    {
        // Validate User Data
            // return appropriate error if validation fails
        // Save user
            // return appropriate error if save fails
        // Return OK status code
    }

    public function updateUser(): void
    {
        // Validate User Data
            // return appropriate error if validation fails
        // Update user
            // return appropriate error if save fails
        // Return OK status code
    }

    public function deleteUser(): void
    {
        // Check permissions
            // self delete or admin delete is okay
            // return appropriate error if delete fails
        // Return OK status code
    }
}
