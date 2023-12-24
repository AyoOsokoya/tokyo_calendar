<?php

namespace App\Domains\Users\Models;

use App\Domains\Users\Enums\EnumUserUserStatus;
use App\Domains\Users\Models\Tables\TableUserUser as _;
use App\Models\User;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $user_id
 * @property int $relation_id
 * @property EnumUserUserStatus $user_user_status
 * @property User $user
 * @property User $relation
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 *
 * @mixin Eloquent
 */
class UserUser extends Model
{
    use HasFactory;

    protected $table = _::table_name;

    protected $fillable = [
        _::user_id,
        _::relation_id,
        _::user_user_status,
    ];

    protected $casts = [
        _::user_user_status => EnumUserUserStatus::class,
    ];
}
