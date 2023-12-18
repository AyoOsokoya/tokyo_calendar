<?php

declare(strict_types=1);

namespace App\Domains\Users\Models;

use App\Domains\Events\Models\Event;
use App\Domains\Spaces\Models\Space;
use App\Domains\Users\Enums\EnumUserAccountStatus;
use App\Domains\Users\Enums\EnumUserAccountType;
use App\Domains\Users\Enums\EnumUserRelationshipStatus;
use App\Domains\Users\Enums\EnumUserSpaceInviteStatus;
use App\Domains\Users\Enums\EnumUserSpaceRoleType;
use App\Domains\Users\Enums\EnumUserType;
use App\Domains\Users\Models\Tables\TableUser as _;
use App\Domains\Users\Models\Tables\TableUserEvent as ue;
use App\Domains\Users\Models\Tables\TableUserRelationshipToUser as ur;
use App\Domains\Users\Models\Tables\TableUserSpace as us;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int $id
 * @property string $name_first
 * @property string $name_last
 * @property string $name_middle
 * @property string $name_handle // nickname
 * @property int $age
 * @property string $user_type
 * @property string $email
 * @property string $account_status
 * @property string $account_type
 * @property string $email_verified_at
 * @property UserEvent $pivot
 * @property Collection $events
 * @property string $password
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $table = _::table_name;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        _::name_first,
        _::name_last,
        _::name_middle,
        _::name_handle,
        _::avatar,
        _::date_of_birth,
        _::user_type,
        _::account_type,
        _::account_status,
        _::email_verified_at,
        _::password,
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        _::password,
        _::remember_token,
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        _::email_verified_at => 'datetime',
        _::user_type => EnumUserType::class,
        _::account_status => EnumUserAccountStatus::class,
        _::account_type => EnumUserAccountType::class,
    ];

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class)
            ->withPivot([
                ue::inviter_id,
                ue::user_id,
                ue::event_id,
                ue::user_event_role_type,
                ue::user_event_attendance_status,
            ])
            ->withTimestamps();
    }

    public function friends(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            ur::table_name,
            ur::user_id,
            ur::relation_id
        )->wherePivot(
            ur::user_relationship_to_user_status,
            EnumUserRelationshipStatus::MUTUAL_FOLLOW
        )->withPivot([
            ur::user_id,
            ur::relation_id,
            ur::user_relationship_to_user_status,
        ])->withTimestamps();
    }

    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            ur::table_name,
            ur::user_id,
            ur::relation_id
        )->wherePivot(
            ur::user_relationship_to_user_status,
            EnumUserRelationshipStatus::FOLLOW
        )->withPivot([
            ur::user_id,
            ur::relation_id,
            ur::user_relationship_to_user_status,
        ])->withTimestamps();
    }

    public function relatedUsers(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            ur::table_name,
            ur::user_id,
            ur::relation_id
        )->wherePivot(
            ur::user_relationship_to_user_status,
        )->withPivot([
            ur::user_id,
            ur::relation_id,
            ur::user_relationship_to_user_status,
        ])->withTimestamps();
    }

    public function spaces(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            us::table_name,
            us::user_id,
            us::space_id
        )->withPivot([
            us::user_id,
            us::space_id,
            us::user_space_invite_status,
            us::user_space_role_type,
        ])->withTimestamps();
    }

    public function isSpaceAdmin(Space $space): bool
    {
        return $this->spaces()
            ->wherePivot(
                us::user_space_role_type,
                EnumUserSpaceRoleType::ADMIN
            )->wherePivot(
                us::space_id,
                $space->id
            )->exists();
    }

    public function isSpaceStaff(Space $space): bool
    {
        return $this->spaces()
            ->wherePivot(
                us::user_space_role_type,
                EnumUserSpaceRoleType::STAFF
            )->wherePivot(
                us::space_id,
                $space->id
            )->exists();
    }

    public function isConnectedToSpace(Space $space): bool
    {
        return $this->spaces()
            ->wherePivot(
                us::space_id,
                $space->id
            )->exists();
    }

    private function hasSpaceInvite(Space $space)
    {
        return $this->spaces()
            ->wherePivot(us::space_id, $space->id)
            ->wherePivot(us::user_id, $this->id)
            ->wherePivotNotIn(
                us::user_space_invite_status,
                [EnumUserSpaceInviteStatus::CANCELLED]
            )->exists();
    }
}
