<?php

namespace App\Models;

use App\Models\Course;
use App\Models\Record;
use App\Models\Section;
use App\Models\Department;
use App\Models\MedicalRecord;
use App\Models\NotificationRequest;
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

    public function course(){
        return $this->belongsTo(Course::class);
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
    
    public function scopeBatchesOfRecord($query, $record){
        return $query->where('record_id', $record);
    }


    public function scopeRecordBatchList($query, $record)
    {
        return $query->where('record_id', $record->id);
    }



    public  function totalUserOfThisBatch(){
        

       return User::notAdmin()->notStaff()->hasPersonalDetails()->noRecordAcademicYearWithBatchDepartment($this)->count();


    }
    public  function totalUserOfThisBatchData(){


       $users = User::notAdmin()->notStaff()->hasPersonalDetails()->noRecordAcademicYearWithBatchDepartment($this)->get();
       
       return $users;

    }


    public function notificationRequests()
    {
        return $this->morphMany(NotificationRequest::class, 'requestable');
    }

    







    


}
