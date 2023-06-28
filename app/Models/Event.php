<?php
declare(strict_types = 1);

namespace App\Models;

use App\Enums\EnumEventStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Event
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property double $longitude
 * @property double $latitude
 * @property string $address
 * @property Carbon $starts_at
 * @property Carbon $ends_at
 * @property string $gallery
 * @property string $url
 * @property string $event_status
 * @property integer $event_source_id
 * @property string $import_unique_id // A unique id for identifying events when being imported (prevents duplication)
 * @property string $event_category
 * @property EventSource source
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
        'address',
        'latitude',
        'longitude',
        'starts_at',
        'ends_at',
        'url',
        'event_status',
        'event_source_id',
        'import_unique_id',
        'event_category'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'ends_at' => 'datetime', // would like to use Carbon::class but get an error
        'starts_at' => 'datetime',
        'gps_json' => 'array',
        'event_status' => EnumEventStatus::class,
    ];

    public function source(): BelongsTo
    {
        return $this->belongsTo(EventSource::class, 'event_source_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
