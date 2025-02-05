<?php

namespace App\Models;

use App\Models\File;
use App\Models\Symptom;
use App\Models\Treatment;
use App\Models\FirstAidGuide;
use App\Models\MedicalRecord;
use App\Models\ConditionSymptom;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
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
    public function getImage()
    {
        // Retrieve the related file
        $file = $this->file;

        // Check if the file exists in storage
        if ($file && !empty($file->file) && Storage::disk('public')->exists($file->file)) {
            return Storage::url($file->file);
        }

        // Return a placeholder image if no valid file is found
        return asset('images/placeholder-image.jpg');
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
