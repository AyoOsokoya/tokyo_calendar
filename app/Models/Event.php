<?php
declare(strict_types = 1);

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * App\Models\Event
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $location
 * @property integer $space_id
 * @property Carbon $start
 * @property Carbon $end
 * @property string $schedule
 * @property string $gallery
 * @property string $url
 * @property string $email
 * @property double $price
 * @property string $status
 * @property string $source_id
 * @property string $category_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 *
 */
class Event extends Model
{
    use HasFactory;

    protected $table = 'events';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
    ];
}
