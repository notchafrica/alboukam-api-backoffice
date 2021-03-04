<?php

namespace App\Models;

use Cog\Laravel\Ban\Traits\Bannable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;
use Orchid\Screen\AsSource;

class Deliver extends Authenticatable
{
    use HasFactory, Notifiable;
    use SoftDeletes;
    use HasApiTokens;
    use Bannable;
    use AsSource;

    protected $guard = 'deliver';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Determine if BannedAtScope should be applied by default.
     *
     * @return bool
     */
    public function shouldApplyBannedAtScope()
    {
        return true;
    }

    static function uid()

    {
        $r = Str::random(5);

        if (self::whereUid($r)->first())
            return self::uid();
        return $r;
    }

    public function parcels()
    {
        return $this->hasMany(DeliverParcel::class);
    }
}
