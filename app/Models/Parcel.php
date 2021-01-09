<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcel extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['transaction'];

    static function uid()
    {
        $r = random_int(10000000, 99999999);
        if (self::whereUid($r)->first()) {
            return self::uid();
        }
        return $r;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }
}
