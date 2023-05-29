<?php
declare(strict_types = 1);

namespace App\Models;

use App\Enums\EnumUserEventAttendanceStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

/**
 * App\Models\UserEvents
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $event_id
 * @property EnumUserEventAttendanceStatus $user_event_attendance_status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class UserEvents extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'user_events';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'event_id',
        'user_event_attendance_status',
    ];

    protected $casts = [
        'user_event_attendance_status' => EnumUserEventAttendanceStatus::class
    ];
}
