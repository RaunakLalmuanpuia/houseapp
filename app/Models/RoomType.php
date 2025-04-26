<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    //
    protected $fillable = ['name','house_id'];
    public function house()
    {
        return $this->belongsTo(House::class);
    }

    public function roomRates()
    {
        return $this->hasMany(RoomRate::class);
    }
}
