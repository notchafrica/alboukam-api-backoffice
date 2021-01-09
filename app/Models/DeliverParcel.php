<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliverParcel extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['parcel', 'deliver'];

    public function parcel()
    {
        return $this->belongsTo(Parcel::class);
    }

    public function deliver()
    {
        return $this->belongsTo(Parcel::class);
    }
}
