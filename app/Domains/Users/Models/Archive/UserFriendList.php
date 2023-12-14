<?php

namespace App\Domains\Users\Models\Archive;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFriendList extends Model
{
    use HasFactory;
    protected $table = 'user_friend_lists';
}
