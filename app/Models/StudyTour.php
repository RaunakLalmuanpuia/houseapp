<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyTour extends Model
{
    //
    use HasFactory;
    protected $fillable = ['application_id','institution', 'institution_approval', 'male','female'];

    public function application() {
        return $this->belongsTo(Application::class);
    }
}
