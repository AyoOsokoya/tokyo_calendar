<?php

declare(strict_types=1);

namespace App\Domains\Location\Models;

use App\Domains\Location\Models\Tables\TableLocation as _;
use App\Domains\Spaces\Models\Space;
use Database\Factories\LocationFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $country
 * @property string $city
 * @property string $street_address
 * @property string $post_code
 * @property string $state_province
 * @property string $other
 *
 * @mixin Eloquent
 */
class Location extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'locations';

    protected $fillable = [
        _::country,
        _::city,
        _::state,
        _::street_address,
        _::post_code,
        _::other,
    ];

    protected $casts = [
        _::country => 'string',
        _::city => 'string',
        _::state => 'string',
        _::street_address => 'string',
        _::post_code => 'string',
        _::other => 'string',
    ];

    public function spaces(): HasMany
    {
        return $this->hasMany(Space::class);
    }

    public static function newFactory(): LocationFactory
    {
        return LocationFactory::new();
    }
}
