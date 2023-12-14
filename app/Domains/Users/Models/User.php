<?php
declare(strict_types=1);

namespace App\Domains\Users\Models;

use App\Domains\Events\Models\Event;
use App\Domains\Spaces\Models\Space;
use App\Domains\Users\Enums\EnumUserRelationshipStatus;
use App\Domains\Users\Enums\EnumUserSpaceInviteStatus;
use App\Domains\Users\Enums\EnumUserSpaceRoleType;
use App\Domains\Users\Enums\EnumUserType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Laravel\Sanctum\HasApiTokens;

use App\Domains\Users\Models\UserTableEnum as t;

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
 * @property UserEvent $pivot
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
        'avatar',
        'date_of_birth',
        'user_type',
        'email_verified_at',
        'password',
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
                'inviter_id',
                'user_id',
                'event_id',
                'user_event_role_type',
                'user_event_attendance_status',
            ])
            ->withTimestamps();
    }

    public function friends(): BelongsToMany
    {
        $table_name = app(UserRelationshipToUser::class);

        return $this->belongsToMany(
            User::class,
            $table_name,
            'user_id',
            'relation_id'
        )->wherePivot(
            'relationship_status',
            EnumUserRelationshipStatus::MUTUAL_FOLLOW
        )->withPivot([
            'user_id',
            'relation_id',
            'relationship_status'
        ])->withTimestamps();
    }

    public function followers(): BelongsToMany
    {
        $table_name = app(UserRelationshipToUser::class);

        return $this->belongsToMany(
            User::class,
            $table_name,
            'user_id',
            'relation_id'
        )->wherePivot(
            'relationship_status',
            EnumUserRelationshipStatus::FOLLOW
        )->withPivot([
            'user_id',
            'relation_id',
            'relationship_status'
        ])->withTimestamps();
    }

    public function relatedUsers(): BelongsToMany
    {
        $table_name = app(UserRelationshipToUser::class);

        return $this->belongsToMany(
            User::class,
            $table_name,
            'user_id',
            'relation_id'
        )->wherePivot(
            'relationship_status',
        )->withPivot([
            'user_id',
            'relation_id',
            'relationship_status'
        ])->withTimestamps();
    }

    public function spaces(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'user_spaces',
            'user_id',
            'space_id'
        )->withPivot([
            'user_id',
            'space_id',
            'user_space_status'
        ])->withTimestamps();
    }

    public function isSpaceAdmin(Space $space): bool
    {
        return $this->spaces()
            ->wherePivot(
                'user_space_role_type',
                EnumUserSpaceRoleType::ADMIN
            )->wherePivot(
                'space_id', $space->id
            )->exists();
    }

    public function isSpaceStaff(Space $space): bool
    {
        return $this->spaces()
            ->wherePivot(
                'user_space_role_type',
                EnumUserSpaceRoleType::STAFF
            )->wherePivot(
                'space_id', $space->id
            )->exists();
    }

    public function isConnectedToSpace(Space $space): bool
    {
        return $this->spaces()
            ->wherePivot(
                'space_id', $space->id
            )->exists();
    }

    private function hasSpaceInvite(Space $space)
    {
        return $this->spaces()
            ->wherePivot('space_id', $space->id)
            ->wherePivot('user_id', $this->id)
            ->wherePivotNotIn(
                'user_space_invite_status',
                [EnumUserSpaceInviteStatus::CANCELLED]
            )->exists();
    }
}
