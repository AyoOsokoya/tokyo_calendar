<?php
declare(strict_types = 1);

namespace App\Domains\Spaces\Models;

use App\Domains\Events\Enums\EnumEventStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Event
 *
 * @property integer $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class Space extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'spaces';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'socials_json',
        'schedule_text',
        'gallery_json',
        'url',
        'space_type',
        'location',
        'coordinates',
        'address',
        'parent_space_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'event_status' => EnumEventStatus::class,
    ];

    // has many users
    // has many events
}