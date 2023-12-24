<?php

declare(strict_types=1);

namespace App\Domains\Users\Models;

use App\Domains\Events\Models\Event;
use App\Domains\Users\Enums\EnumUserEventAttendanceStatus;
use App\Domains\Users\Enums\EnumUserEventRoleType;
use App\Domains\Users\Models\Tables\TableUserEvent as _;
use App\Models\User;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\UserEvents
 *
 * @property int $user_id
 * @property int $event_id
 * @property int $inviter_id
 * @property EnumUserEventAttendanceStatus $user_event_attendance_status
 * @property EnumUserEventRoleType $user_event_role_type
 * @property User $user
 * @property Event $event
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 *
 * @mixin Eloquent
 */
class UserEvent extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = _::table_name;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        _::inviter_id,
        _::event_id,
        _::user_id,
        _::user_event_role_type,
        _::user_event_attendance_status,
    ];

    protected $casts = [
        _::user_event_attendance_status => EnumUserEventAttendanceStatus::class,
        _::user_event_role_type => EnumUserEventRoleType::class,
    ];
}
