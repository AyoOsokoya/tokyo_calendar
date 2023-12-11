<?php
declare(strict_types=1);

namespace App\Domains\Location\Models;

use App\Domains\Spaces\Models\Space;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

// TODO: Implement

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
        'country',
        'city',
        'street_address',
        'post_code',
        'state_province',
        'other',
    ];

    protected $casts = [
        'country' => 'string',
        'city' => 'string',
        'street_address' => 'string',
        'post_code' => 'string',
        'state_province' => 'string',
        'other' => 'string',
    ];

    public function spaces(): HasMany
    {
        return $this->hasMany(Space::class);
    }
}
