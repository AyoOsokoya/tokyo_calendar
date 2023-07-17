<?php
declare(strict_types = 1);

namespace App\Models;

use App\Enums\EnumEventUserAttendanceStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\UserEvents
 *
 * @property integer $user_id
 * @property User $user
 * @property integer $event_id
 * @property Event $event
 * @property EnumEventUserAttendanceStatus $user_event_attendance_status
 * @property Carbon $starts_at // for long-running events, the attendance can be set separately from the event start/end
 * @property Carbon $ends_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class EventUser extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'event_user';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'event_id',
        'date_attend',
        'user_event_attendance_status',
    ];

    protected $casts = [
        'user_event_attendance_status' => EnumEventUserAttendanceStatus::class,
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];
}
