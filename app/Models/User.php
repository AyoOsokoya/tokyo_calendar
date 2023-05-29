<?php
declare(strict_types = 1);

namespace App\Models;

use App\Enums\EnumUserType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @package App\Models\User
 *
 * @property string $name_first
 * @property string $name_last
 * @property string $name_middle
 * @property string $name_handle
 * @property integer $age
 * @property string $sex
 * @property string $user_type
 * @property string $email
 * @property string $email_verified_at
 * @property string $password
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name_first',
        'name_last',
        'name_middle',
        'name_handle',
        'age',
        'user_type',
        'email',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'user_type' => EnumUserType::class
    ];
}
