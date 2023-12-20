<?php

declare(strict_types=1);

namespace App\Domains\Events\Models;

use App\Domains\Events\Enums\EnumEventSourceDataType;
use App\Domains\Events\Models\Tables\TableEventSource as _;
use Database\Factories\EventSourceFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * App\Models\EventSource
 *
 * @property int $id
 * @property string $name_display
 * @property string $name_display_short
 * @property string $name_importer
 * @property string $event_source_data_type
 * @property string $command_name
 * @property string $command_parameters
 * @property string $base_url
 * @property string $email
 * @property string $phone_number
 * @property Collection $events
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class EventSource extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'event_sources';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        _::name_display,
        _::name_display_short,
        _::name_importer,
        _::event_source,
        _::event_source_data_type,
        _::command_name,
        _::command_parameters,
        _::base_url,
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        _::event_source_data_type => EnumEventSourceDataType::class,
    ];

    // haveManyEvents
    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    public static function newFactory(): EventSourceFactory
    {
        return EventSourceFactory::new();
    }
}
