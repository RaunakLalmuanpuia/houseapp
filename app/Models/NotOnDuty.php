<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotOnDuty extends Model
{
    //
    use HasFactory;
    protected $fillable = ['application_id', 'name', 'designation','department_id', 'gender', 'contact'];
    public function application() {
        return $this->belongsTo(Application::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
