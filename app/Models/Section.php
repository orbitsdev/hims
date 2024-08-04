<?php

namespace App\Models;

use App\Models\Course;
use App\Models\Student;
use App\Models\RecordBatch;
use App\Models\MedicalRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Section extends Model
{
    use HasFactory;

    public function course(){
        return $this->belongsTo(Course::class);
    }
    public function recordBatches(){
        return $this->hasMany(RecordBatch::class);
    }

    public function students(){
        return $this->hasMany(Student::class);
    }

    public function medicalRecords(){
        return $this->hasMany(MedicalRecord::class);
    }
   

}
