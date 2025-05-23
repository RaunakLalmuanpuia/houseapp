<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class MedicalDetail extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'application_id',
        'category',
        'service',
        'name',
        'gender',
        'contact',
        'designation',
        'department_id',
        'file_path',
    ];

    public function application() {
        return $this->belongsTo(Application::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

}
