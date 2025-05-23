<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyMember extends Model
{
    //
    use HasFactory;
    protected $fillable = ['application_id', 'name', 'relation'];

    public function application() {
        return $this->belongsTo(Application::class);
    }


}
