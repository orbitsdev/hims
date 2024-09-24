<?php

namespace App\Models;

use App\Models\Semester;
use App\Models\Department;
use App\Models\AcademicYear;
use App\Models\DepartmentEvent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    public function academicYear(){
        return $this->belongsTo(AcademicYear::class);

    }
    public function semester(){
        return $this->belongsTo(Semester::class);

    }
    public function file(): MorphOne
    {
        return $this->morphOne(File::class, 'fileable');
    }
    public function getImage()
        {
            if (!empty($this->image) && Storage::disk('public')->exists($this->image)) {
                return Storage::disk('public')->url($this->image);
            } else {
                return asset('images/placeholder-image.jpg'); // Return default image URL
            }
        }

    public function evenDate(){
        return optional($this->created_at)->format('F d, Y');
    }



        public function departments(){
            return $this->belongsToMany(Department::class ,'department_events', 'event_id', 'department_id');
        }


        public function departmentEvents(){
            return $this->hasMany(DepartmentEvent::class);
        }


}
