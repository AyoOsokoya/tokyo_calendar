<?php
declare(strict_types = 1);

namespace App\Domains\Users\Models;

use App\Domains\Events\Enums\EnumEventUserAttendanceStatus;
use App\Domains\Events\Models\Event;
use App\Domains\Events\Models\EventUser;
use App\Domains\Users\Enums\EnumUserType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Laravel\Sanctum\HasApiTokens;

/**
 * @package App\Models\User
 *
 * @property integer $id
 * @property string $name_first
 * @property string $name_last
 * @property string $name_middle
 * @property string $name_handle // nickname
 * @property integer $age
 * @property string $user_type
 * @property string $email
 * @property string $email_verified_at
 * @property EventUser $pivot
 * @property Collection $events
 * @property string $password
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name_first',
        'name_last',
        'name_middle',
        'name_handle',
        'age',
        'user_type',
        'email',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'user_type' => EnumUserType::class
    ];

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class)
            ->withPivot([
                'user_id',
                'event_id',
                'starts_at',
                'ends_at',
                'user_event_attendance_status'
            ])
             ->withTimestamps();
    }

    public function attendEvent(Event $event, Carbon $starts_at, Carbon $ends_at, EnumEventUserAttendanceStatus $status)
    {
        // For now, just attend the event for 3 hours we need a more complicated event schedule model
        // check starts at and $ends at are between event times and now
        $this->events()->attach(
            $event,
            [
                'user_event_attendance_status' => $status,
                'starts_at' => $starts_at,
                'ends_at' => $starts_at->addHours(3)
            ]
        );
    }
}
