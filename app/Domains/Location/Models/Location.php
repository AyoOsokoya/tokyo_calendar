<?php
declare(strict_types=1);

namespace App\Domains\Location\Models;

use App\Domains\Spaces\Models\Space;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Domains\Location\Models\Tables\TableLocation as _;

/**
 * @package App\Domains\Location\Models
 *
 * @property integer $id
 * @property string $country
 * @property string $city
 * @property string $street_address
 * @property string $post_code
 * @property string $state_province
 * @property string $other
 * @mixin Eloquent
 */
class Location extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'locations';

    protected $fillable = [
        _::country,
        _::city,
        _::street_address,
        _::post_code,
        _::state_province,
        _::other,
    ];

    protected $casts = [
        _::country => 'string',
        _::city => 'string',
        _::street_address => 'string',
        _::post_code => 'string',
        _::state_province => 'string',
        _::other => 'string',
    ];

    public function spaces(): HasMany
    {
        return $this->hasMany(Space::class);
    }
}
