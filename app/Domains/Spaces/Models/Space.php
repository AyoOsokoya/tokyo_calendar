<?php
declare(strict_types = 1);

namespace App\Domains\Spaces\Models;

use App\Domains\Events\Models\Event;
use App\Domains\Spaces\Enums\EnumSpaceActivityStatus;
use App\Domains\Spaces\Enums\EnumSpaceVerificationStatus;
use App\Domains\Users\Models\User;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Event
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property array $socials_json
 * @property string $schedule_text
 * @property array $gallery_json
 * @property string $website_url
 * @property EnumSpaceActivityStatus $space_activity_status
 * @property EnumSpaceVerificationStatus $space_verification_status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 * @mixin Eloquent
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
        'website_url',
        'space_activity_status',
        'space_verification_status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'name' => 'string',
        'description' => 'string',
        'socials_json' => 'array',
        'schedule_text' => 'string',
        'gallery_json' => 'array',
        'website_url' => 'string',
        'space_activity_status' => EnumSpaceActivityStatus::class,
        'space_verification_status' => EnumSpaceVerificationStatus::class,
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'users_spaces',
            'space_id',
            'user_id'
        );
    }

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(
            Event::class,
            'events_spaces',
            'space_id',
            'event_id'
        );
    }
}
