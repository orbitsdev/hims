<?php

namespace App\Models;

use App\Models\Record;
use App\Models\Section;
use App\Models\Department;
use App\Models\MedicalRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RecordBatch extends Model
{
    use HasFactory;


    const PENDING = 'Pending';
    const COMPLETE = 'Complete';
    const ONGOING = 'Ongoing';
    const CANCELLED = 'Cancelled';

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function section(){
        return $this->belongsTo(Section::class);
    }

    public function record(){
        return $this->belongsTo(Record::class);
    }

    public function medicalRecords(){
        return $this->hasMany(MedicalRecord::class);
    }
}
