<?php
declare(strict_types = 1);

namespace App\Models;

use App\Enums\EnumEventSourceDataType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\EventSource
 *
 * @property integer $id
 * @property integer $name_display
 * @property string $name_importer
 * @property string $event_source_data_type
 * @property string $command_name
 * @property string $command_parameters
 * @property string $base_url
 * @property string $email
 * @property string $phone_number
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class EventSource extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'event_source';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name_display',
        'name_importer',
        'event_source',
        'event_source_data_type',
        'command_name',
        'command_parameters',
        'base_url',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'event_source_data_type' => EnumEventSourceDataType::class
    ];

    // haveManyEvents
    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}
