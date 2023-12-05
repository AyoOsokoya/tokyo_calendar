<?php

namespace App\Domains\Users\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FriendListUser extends Model
{
    use HasFactory;
    protected $table = 'friend_list_users';
}
