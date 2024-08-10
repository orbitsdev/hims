<?php

namespace App\Models;

use App\Models\User;
use App\Models\Course;
use App\Models\Record;
use App\Models\Section;
use App\Models\Condition;
use App\Models\Department;
use App\Models\RecordBatch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MedicalRecord extends Model
{
    use HasFactory;

    const STATUS_DONE = 'DONE';
    const STATUS_NOT_COMPLETE = 'Not Complete';
    const STATUS_NO_RECORD = 'No Record';
   

    // $record->date_of_examination = Carbon::now()->format('Y-m-d');

    public function record(){
        return $this->belongsTo(Record::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function recorder(){
        return $this->belongsTo(User::class,'recorder_id');
    }
    public function recordBatch(){
        return $this->belongsTo(RecordBatch::class);
    }
    public function section(){
        return $this->belongsTo(Section::class);
    }
    public function course(){
        return $this->belongsTo(Course::class);
    }
    public function department(){
        return $this->belongsTo(Department::class);
    }
    public function condition(){
        return $this->belongsTo(Condition::class);
    }

    
}
