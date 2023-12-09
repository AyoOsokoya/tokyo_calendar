<?php

namespace App\Domains\Users\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRelationshipToUser extends Model
{
    use HasFactory;
    protected $table = 'user_friends';
}
