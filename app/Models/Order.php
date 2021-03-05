<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Metrics\Chartable;
use Orchid\Screen\AsSource;

class Order extends Model
{
    use HasFactory;
    use AsSource;
    use Chartable;
    protected $guarded = ['id'];

    public function products()
    {
        return $this->hasMany(OrderProduct::class);
    }

    static function uid()
    {
        $r = random_int(10000000, 99999999);
        if (self::whereUid($r)->first()) {
            return self::uid();
        }
        return $r;
    }
}
