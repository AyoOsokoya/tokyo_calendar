<?php
declare(strict_types = 1);

namespace App\Models;

use App\Enums\EnumEventStatus;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Event
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $location
 * @property string $starts_at
 * @property string $ends_at
 * @property string $gallery
 * @property string $url
 * @property string $email
 * @property string $event_status
 * @property string $source_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 *
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
        'location',
        'starts_at',
        'ends_at',
        'url',
        'event_status',
        'event_gallery_id',
        'event_source_id',
        'event_creator_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'event_status' => EnumEventStatus::class,
    ];
}
