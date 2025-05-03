<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    //
    protected $fillable = ['name','state_id'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function applications()
    {
        return $this->hasMany(Application::class, 'location');
    }
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function roomTypes()
    {
        return $this->hasMany(RoomType::class);
    }

}
