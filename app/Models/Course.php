<?php

namespace App\Models;

use App\Models\Section;
use App\Models\Student;
use App\Models\Department;
use App\Models\RecordBatch;
use App\Models\MedicalRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;


    public function sections(){
        return $this->hasMany(Section::class);
    }
    public function students(){
        return $this->hasMany(Student::class);
    }
    public function recordBatches(){
        return $this->hasMany(RecordBatch::class);
    }


    public function department(){
        return $this->belongsTo(Department::class);
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
    public function hasSections(): bool
{
    return $this->sections()->exists();
}

}
