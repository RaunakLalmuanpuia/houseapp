<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'type',
        'status',
        'application_id',
        'applicant_name',
        'gender',
        'designation',
        'department_id',
        'department_approval',
        'contact',
        'number_of_persons',
        'location',
        'start_date',
        'end_date',
        'status_changed_at',
        'reject_reason'
    ];

    public function statusHistories()
    {
        return $this->hasMany(ApplicationStatusHistory::class);
    }
    public function house()
    {
        return $this->belongsTo(House::class, 'location');
    }
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
    public function flamDetails() {
        return $this->hasMany(FlamDetail::class);
    }
    public function onDutyDetails() {
        return $this->hasMany(OnDuty::class);
    }

    public function notOnDutyDetails() {
        return $this->hasMany(NotOnDuty::class);
    }

    public function nonOfficialDetails() {
        return $this->hasMany(NonOfficial::class);
    }

    public function studyTourDetails() {
        return $this->hasOne(StudyTour::class);
    }

    public function medicalDetails() {
        return $this->hasMany(MedicalDetail::class);
    }

    public function familyMembers() {
        return $this->hasMany(FamilyMember::class);
    }
}
