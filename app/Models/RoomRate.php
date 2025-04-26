<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomRate extends Model
{
    //
    protected $fillable = ['room_type_id', 'rate_category_id', 'rate'];
    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }

    public function rateCategory()
    {
        return $this->belongsTo(RateCategory::class);
    }
}
