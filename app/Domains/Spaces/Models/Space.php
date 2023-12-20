<?php

declare(strict_types=1);

namespace App\Domains\Spaces\Models;

use App\Domains\Events\Models\Event;
use App\Domains\Location\Models\Location;
use App\Domains\Spaces\Enums\EnumSpaceActivityStatus;
use App\Domains\Spaces\Enums\EnumSpaceVerificationStatus;
use App\Domains\Spaces\Models\Tables\TableSpace as _;
use App\Domains\Users\Models\Tables\TableUserSpace as us;
use App\Domains\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Space extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = _::table_name;

    protected $fillable = [
        _::name,
        _::description,
        _::socials_json,
        _::schedule_text,
        _::gallery_json,
        _::website_url,
        _::location_id,
        _::space_activity_status,
        _::space_verification_status,
    ];

    protected $casts = [
        _::name => 'string',
        _::description => 'string',
        _::socials_json => 'array',
        _::schedule_text => 'string',
        _::gallery_json => 'array',
        _::website_url => 'string',
        _::space_activity_status => EnumSpaceActivityStatus::class,
        _::space_verification_status => EnumSpaceVerificationStatus::class,
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            us::table_name,
            us::space_id,
            us::user_id
        );
    }

    public function events(): HasMany
    {
        return $this->hasMany(
            Event::class,
        );
    }

    public function location(): HasOne
    {
        return $this->hasOne(
            Location::class,
        );
    }
}
