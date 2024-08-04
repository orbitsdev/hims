<?php

namespace App\Models;

use App\Models\Record;
use App\Models\AcademicYear;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Semester extends Model
{
    use HasFactory;

    public function academicYear(){
        return $this->belongsTo(AcademicYear::class);
    }

    public function semesterWithYear(){
        return $this->name_in_number.' ('.$this->academicYear->name.')';   
    }

    public function records(){
        return $this->hasMany(Record::class);
    }

}
