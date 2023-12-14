<?php
declare(strict_types = 1);

namespace App\Domains\Events\Models;

use App\Domains\Events\Enums\EnumEventCategories;
use App\Domains\Events\Enums\EnumEventStatus;
use App\Domains\Location\Models\Location;
use App\Domains\Users\Models\User;
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
 * @property integer $id
 * @property string $name
 * @property string $description
 *
 * @property Carbon $starts_at
 * @property Carbon $ends_at
 * @property EnumEventStatus $event_status
 * @property array $gallery_json
 * @property string $url
 * @property string $url_cover_image
 *
 * @property EnumEventCategories $event_category
 *
 * @property integer $event_source_id
 * @property string $import_unique_id // A unique id for identifying events when being imported (prevents duplication)
 * @property string $import_data_hash // If the hash changes, something in the event info has been updated
 *
 * @property EventSource $event_source
 * @property Collection $users
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'events';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',

        'space_id',

        'starts_at',
        'ends_at',
        'event_status',

        'gallery_json',
        'event_category',
        'url_cover_image',
        'url',

        'event_source_id',
        'import_unique_id',
        'import_data_hash',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'ends_at' => 'datetime',
        'starts_at' => 'datetime',
        'gallery_json' => 'array',
        'event_category' => EnumEventCategories::class,
        'event_status' => EnumEventStatus::class,
    ];

    public function eventSource(): BelongsTo
    {
        return $this->belongsTo(EventSource::class, 'event_source_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function space(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'space_id');
    }
}
