<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function parcel()
    {
        return $this->belongsTo(Parcel::class);
    }

    public static function reference()
    {
        $r = Str::random(16);

        if (self::whereReference($r)->first())
            return self::reference();
        return $r;
    }
}
