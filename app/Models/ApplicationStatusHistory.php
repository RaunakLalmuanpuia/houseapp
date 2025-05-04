<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationStatusHistory extends Model
{
    //
    protected $fillable = [
        'application_id',
        'handled_by',
        'role',
        'action',
        'note',
        'priority',
    ];

    public function handler()
    {
        return $this->belongsTo(User::class, 'handled_by');
    }

    public function application()
    {
        return $this->belongsTo(Application::class);
    }

}
