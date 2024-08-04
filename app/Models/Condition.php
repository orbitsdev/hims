<?php

namespace App\Models;

use App\Models\File;
use App\Models\Symptom;
use App\Models\Treatment;
use App\Models\FirstAidGuide;
use App\Models\MedicalRecord;
use App\Models\ConditionSymptom;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Condition extends Model
{
    use HasFactory;

    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }
    public function file(): MorphOne
    {
        return $this->morphOne(File::class, 'fileable');
    }

    public function treatments(){
        return $this->hasMany(Treatment::class, 'condition_id');
    }

    public function symptoms()
    {
        return $this->belongsToMany(Symptom::class, 'condition_symptom');
    }
    public function conditionSymptoms()
    {
        return $this->hasMany(ConditionSymptom::class);
    }

    public function firstAidGuides(){
        return $this->hasMany(FirstAidGuide::class);
    }

    public function medicalRecords(){
        return $this->hasMany(MedicalRecord::class);
    }
}
