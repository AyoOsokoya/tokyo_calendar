<?php

namespace App\Domains\Users\Models;

use App\Domains\Users\Enums\EnumUserRelationshipStatus;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @package App\Models\UserRelationships
 *
 * @property integer $user_id
 * @property integer $relation_id
 * @property EnumUserRelationshipStatus $user_relationship_status
 * @property User $user
 * @property User $relation
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 * @mixin Eloquent
 */
class UserRelationshipToUser extends Model
{
    use HasFactory;
    protected $table = 'user_friends';

    protected $fillable = [
        'user_id',
        'relation_id',
        'user_relationship_status',
    ];

    protected $casts = [
        'user_relationship_status' => EnumUserRelationshipStatus::class,
    ];
}
