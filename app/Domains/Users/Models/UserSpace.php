<?php

declare(strict_types=1);

namespace App\Domains\Users\Models;

use App\Domains\Spaces\Models\Space;
use App\Domains\Users\Enums\EnumUserSpaceInviteStatus;
use App\Domains\Users\Enums\EnumUserSpaceRoleType;
use App\Domains\Users\Models\Tables\TableUserSpace as _;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int $user_id
 * @property int $space_id
 * @property EnumUserSpaceRoleType $user_space_role_type
 * @property EnumUserSpaceInviteStatus $user_space_invite_status
 * @property User $user
 * @property Space $space
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 *
 * @mixin Eloquent
 */
class UserSpace extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = _::table_name;

    protected $fillable = [
        _::user_id,
        _::space_id,
        _::user_space_role_type,
        _::user_space_invite_status,
    ];

    protected $casts = [
        _::user_space_role_type => EnumUserSpaceRoleType::class,
        _::user_space_invite_status => EnumUserSpaceInviteStatus::class,
    ];
}
