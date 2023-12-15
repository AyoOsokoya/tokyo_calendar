<?php

namespace App\Http\Controllers;

class UserList extends Controller
{
    public function lists(): void
    {
        // return user list with users
    }

    public function userLists(): void
    {
        // return a list of all user's lists
    }

    public function createUserList(): void
    {
        // take array of users ids
        // check they follow you
        // save new user list
    }

    public function updateUserList(): void
    {
        // take array of users ids
        // check they are friends
        // update user list
    }

    public function deleteUserList(): void
    {
    }
}
