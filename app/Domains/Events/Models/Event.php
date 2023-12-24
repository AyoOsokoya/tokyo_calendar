<?php

declare(strict_types=1);

namespace App\Domains\Events\Models;

use App\Domains\Events\Enums\EnumEventCategories;
use App\Domains\Events\Enums\EnumEventStatus;
use App\Domains\Events\Models\Tables\TableEvent as _;
use App\Domains\Spaces\Models\Space;
use App\Domains\Users\Models\Tables\TableUser as u;
use App\Domains\Users\Models\Tables\TableUserEvent as ue;
use App\Models\User;
use Database\Factories\EventFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * App\Models\Event
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property Carbon $starts_at
 * @property Carbon $ends_at
 * @property EnumEventStatus $event_status
 * @property array $gallery_json
 * @property string $url
 * @property string $url_cover_image
 * @property EnumEventCategories $event_category
 * @property int $event_source_id
 * @property string $import_unique_id // A unique id for identifying events when being imported (prevents duplication)
 * @property string $import_data_hash // If the hash changes, something in the event info has been updated
 * @property EventSource $event_source
 * @property Collection $users
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = _::table_name;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        _::name,
        _::description,

        _::space_id,

        _::starts_at,
        _::ends_at,
        _::event_status,

        _::gallery_json,
        _::event_category,
        _::url_cover_image,
        _::url,

        _::event_source_id,
        _::import_unique_id,
        _::import_data_hash,
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        _::ends_at => 'datetime',
        _::starts_at => 'datetime',
        _::gallery_json => 'array',
        _::event_category => EnumEventCategories::class,
        _::event_status => EnumEventStatus::class,
    ];

    public function eventSource(): BelongsTo
    {
        return $this->belongsTo(EventSource::class, _::event_source_id);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            ue::table_name,
            ue::event_id,
            ue::user_id
        )->withTimestamps();
    }

    public function space(): BelongsTo
    {
        return $this->belongsTo(Space::class, _::space_id);
    }

    public static function newFactory(): EventFactory
    {
        return EventFactory::new();
    }

    public function scopeWithUsers($query): void
    {
        $query->with([
            'users' => function ($query) {
                $query->select([
                    u::id,
                    u::name_first,
                    u::name_last,
                    u::name_middle,
                    u::name_handle,
                    u::avatar,
                    u::date_of_birth,
                    u::staff_role,
                    u::account_type,
                    u::activity_status,
                    u::email_verified_at,
                    u::password,
                    u::remember_token,
                ]);
            },
        ]);
    }
}
