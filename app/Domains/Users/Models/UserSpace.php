<?php
declare(strict_types=1);

namespace App\Domains\Users\Models;

use App\Domains\Spaces\Models\Space;
use App\Domains\Users\Enums\EnumUserSpaceInviteStatus;
use App\Domains\Users\Enums\EnumUserSpaceRoleType;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @package App\Models\UserSpaces
 *
 * @property integer $user_id
 * @property integer $space_id
 * @property EnumUserSpaceRoleType $user_space_role_type
 * @property EnumUserSpaceInviteStatus $user_space_invite_status
 * @property User $user
 * @property Space $space
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 * @mixin Eloquent
 */
class UserSpace extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'user_spaces';

    protected $fillable = [
        'user_id',
        'space_id',
        'user_space_role_type',
        'user_space_invite_status'
    ];

    protected $casts = [
        'user_space_role_type' => EnumUserSpaceRoleType::class,
        'user_space_invite_status' => EnumUserSpaceInviteStatus::class,
    ];
}
