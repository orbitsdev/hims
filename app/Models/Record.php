<?php

namespace App\Models;

use App\Models\Semester;
use App\Models\RecordBatch;
use App\Models\AcademicYear;
use App\Models\MedicalRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Record extends Model
{
    use HasFactory;


    const ONGOING = 'Ongoing';
    const COMPLETED = 'Completed';
    const CANCELLED = 'Cancelled';

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }
    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function recordBatches()
    {
        return $this->hasMany(RecordBatch::class);
    }

    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class);
    }

    public function hasBatch()
    {
        return $this->recordBatches()->exists();
    }

    public function totalBatches()
    {
        return $this->recordBatches()->count();
    }

    public function isComplete(){
        
        $count = User::query()
        ->notAdmin()
        ->notStaff()
        ->hasPersonalDetails()
        ->noRecordInThisAcademicYearAndSemester($this)
        ->count();   

        return $count > 0 ? false :true;
    }
   
}
