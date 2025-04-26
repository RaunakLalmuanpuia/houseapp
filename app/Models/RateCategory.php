<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RateCategory extends Model
{
    //
    protected $fillable = ['name'];
    public function roomRates()
    {
        return $this->hasMany(RoomRate::class);
    }
}
