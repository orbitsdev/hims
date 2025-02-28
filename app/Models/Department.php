<?php

namespace App\Models;

use App\Models\User;
use App\Models\Event;
use App\Models\Staff;
use App\Models\Course;
use App\Models\Section;
use App\Models\Student;
use App\Models\Personnel;
use App\Models\RecordBatch;
use App\Models\MedicalRecord;
use App\Models\DepartmentEvent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;


    const CCS = 'COLLEGE OF COMPUTER STUDY (CCS)';
    const NABA = 'COLLEGE OF INDUSTRIAL TECHNOLOGY (NBA)';
    const ESO = 'ENGINEERING STUDENTS ORGANIZATION (ESO)';

    const LIST = [
        //   User::ADMIN => User::ADMIN,
          Department::CCS => Department::CCS,
          Department::NABA => Department::NABA,
          Department::ESO => Department::ESO,

        ];

    public function students(){
        return $this->hasMany(Student::class);
    }
    public function staffs(){
        return $this->hasMany(Staff::class);
    }
    public function personnels(){
        return $this->hasMany(Personnel::class);
    }


    public function recordBatches(){
        return $this->hasMany(RecordBatch::class);
    }

    public function courses(){
        return $this->hasMany(Course::class);
    }

    public function sections(){
        return $this->hasMany(Section::class);
    }





    public function getImage()
    {
        if (!empty($this->image) && Storage::disk('public')->exists($this->image)) {
            return Storage::disk('public')->url($this->image);
        } else {
            return asset('images/placeholder-image.jpg'); // Return default image URL
        }
    }

    public function getNameWithAbbreviation()
    {
        $name = $this->name ?? '';
    $abbreviation = $this->abbreviation ? ' (' . $this->abbreviation . ')' : '';

    return $name . $abbreviation;
    }


    public function medicalRecords(){
        return $this->hasMany(MedicalRecord::class);
    }

    public function departments(){
        return $this->belongsToMany(Department::class);
    }

    public function events(){
        return $this->belongsToMany(Event::class, 'department_events','department_id', 'event_id');
    }



    public function departmentEvents(){
        return $this->hasMany(DepartmentEvent::class);
    }

    public function scopeStudentDepartment($query){
        return $query->where('role', User::STUDENT);
    }
    public function scopeStaffDepartment($query){
        return $query->where('role', User::STAFF);
    }
    public function scopePersonnelDepartment($query){
        return $query->where('role', User::PERSONNEL);
    }

    public function hasRelatedRecords(): bool
{
    return $this->students()->exists() ||
           $this->staffs()->exists() ||
           $this->personnels()->exists() ||
           $this->recordBatches()->exists() ||
           $this->courses()->exists() ||
           $this->medicalRecords()->exists() ||
           $this->departmentEvents()->exists();
}


}
