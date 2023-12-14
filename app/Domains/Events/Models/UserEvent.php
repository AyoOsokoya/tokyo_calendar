<?php
declare(strict_types = 1);

namespace App\Domains\Events\Models;

use App\Domains\Events\Enums\EnumEventUserAttendanceStatus;
use App\Domains\Users\Enums\EnumUserEventRoleType;
use App\Domains\Users\Models\User;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\UserEvents
 *
 * @property integer $user_id
 * @property integer $event_id
 * @property integer $inviter_id
 * @property EnumEventUserAttendanceStatus $user_event_attendance_status
 * @property EnumUserEventRoleType $user_event_role_type
 * @property User $user
 * @property Event $event
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 * @mixin Eloquent
 */
class UserEvent extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'user_events';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'inviter_id',
        'event_id',
        'user_id',
        'user_event_role_type',
        'user_event_attendance_status',
    ];

    protected $casts = [
        'user_event_attendance_status' => EnumEventUserAttendanceStatus::class,
        'user_event_role_type' => EnumUserEventRoleType::class,
    ];
}
