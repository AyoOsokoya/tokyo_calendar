<?php

namespace App\Domains\Users\Models;

use App\Domains\Users\Enums\EnumUserRelationshipStatus;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

use App\Domains\Users\Models\Tables\TableUserRelationshipToUser as _;

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
    protected $table = _::table_name;

    protected $fillable = [
        _::user_id,
        _::relation_id,
        _::user_relationship_to_user_status,
    ];

    protected $casts = [
        _::user_relationship_to_user_status => EnumUserRelationshipStatus::class,
    ];
}
