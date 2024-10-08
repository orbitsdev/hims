<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Course;
use App\Models\Record;
use App\Models\Section;
use App\Models\Condition;
use App\Models\Department;
use App\Models\RecordBatch;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MedicalRecord extends Model
{
    use HasFactory;

    const STATUS_DONE = 'DONE';
    const STATUS_NOT_COMPLETE = 'Not Complete';
    const STATUS_NO_RECORD = 'No Record';

    const NORMAL = 'No Record';
    const ELEVATED = 'No Record';
    const HYPERTENSION_STAGE1 = 'Hypertension Stage 1';
    const HYPERTENSION_STAGE2 = 'Hypertension Stage 2';
    const HYPERTENSIVE_CRISIS = 'Hypertension Stage 2';


    public function medicalCreated(){
        return optional($this->created_at)->format('F d, Y');
    }



    // $record->date_of_examination = Carbon::now()->format('Y-m-d');

    public function record()
    {
        return $this->belongsTo(Record::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function recorder()
    {
        return $this->belongsTo(User::class, 'recorder_id');
    }
    public function recordBatch()
    {
        return $this->belongsTo(RecordBatch::class);
    }
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function condition()
    {
        return $this->belongsTo(Condition::class);
    }


    public function getBloodPressureStatus()
{
    $systolic = $this->systolic_pressure;
    $diastolic = $this->diastolic_pressure;
    $age = $this->age;

    if ($age < 13) {
        // Children's blood pressure ranges
        if ($systolic < 110 && $diastolic < 70) {
            return 'Normal';
        } elseif ($systolic >= 110 && $systolic <= 120 && $diastolic < 80) {
            return 'Elevated';
        } elseif ($systolic > 120 || $diastolic > 80) {
            return 'Hypertension Stage 1';
        }
    } elseif ($age < 18) {
        // Adolescent blood pressure ranges
        if ($systolic < 120 && $diastolic < 80) {
            return 'Normal';
        } elseif ($systolic >= 120 && $systolic <= 130 && $diastolic < 80) {
            return 'Elevated';
        } elseif ($systolic > 130 || $diastolic > 80) {
            return 'Hypertension Stage 1';
        }
    } else {
        // Adult blood pressure ranges
        if ($systolic < 120 && $diastolic < 80) {
            return 'Normal';
        } elseif ($systolic >= 120 && $systolic <= 129 && $diastolic < 80) {
            return 'Elevated';
        } elseif (($systolic >= 130 && $systolic <= 139) || ($diastolic >= 80 && $diastolic <= 89)) {
            return 'Hypertension Stage 1';
        } elseif ($systolic >= 140 || $diastolic >= 90) {
            return 'Hypertension Stage 2';
        } elseif ($systolic > 180 || $diastolic > 120) {
            return 'Hypertensive Crisis';
        }
    }

    return 'Unknown';
}



    public function uploadImageActualPath()
    {

        if (!empty($this->upload_image)) {
            if (Storage::disk('public')->exists($this->upload_image)) {
                return Storage::disk('public')->path($this->upload_image);
            } else {
                return public_path('images/placeholder-image.jpg');
            }
        } else {
            return public_path('images/placeholder-image.jpg');
        }
    }
    public function getUploadImage()
    {

        if (!empty($this->upload_image)) {
            if (Storage::disk('public')->exists($this->upload_image)) {
                return Storage::disk('public')->url($this->upload_image);
            } else {
                return asset('images/placeholder-image.jpg');
            }
        } else {
            return asset('images/placeholder-image.jpg');
        }
    }


    public function fullName(){
        return  Str::upper($this->last_name) .' ' .Str::upper($this->first_name);
    }
    public function fullNameLower(){
        return  $this->last_name .' ' .$this->first_name;
    }

    public function birthDateFormat(){
        return Carbon::parse($this->birth_date)->format('F j, Y');
    }


    public function getBloodPressureSuggestion()
    {
        // Calculate the blood pressure status
        $status = $this->getBloodPressureStatus();

        // Determine the age group
        $age = $this->age;
        $ageGroup = $this->getAgeGroup($age);

        // Fetch the suggestion from the suggestions table
        $suggestion = Suggestion::where('status', $status)
                                ->where('age_group', $ageGroup)
                                ->first();

        return $suggestion ? $suggestion->suggestion : 'No suggestion available.';
    }

    private function getAgeGroup($age)
    {
        if ($age < 13) {
            return 'child';
        } elseif ($age >= 13 && $age < 18) {
            return 'adolescent';
        } else {
            return 'adult';
        }
    }


public function bloodPressureLevel(){
    return  $this->belongsTo(BloodPressureLevel::class);
}

}
