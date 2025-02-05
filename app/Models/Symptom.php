<?php

namespace App\Models;

use App\Models\File;
use App\Models\Condition;
use App\Models\ConditionSymptom;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Symptom extends Model
{
    use HasFactory;

    public function conditions()
    {
        return $this->belongsToMany(Condition::class, 'condition_symptom');
    }

    public function conditionSymptoms()
    {
        return $this->hasMany(ConditionSymptom::class);
    }

    public function getImage()
    {
        // Retrieve the related file
        $file = $this->file;
    
        // Check if the file exists and has a valid path
        if ($file && !empty($file->file) && is_string($file->file) && Storage::disk('public')->exists($file->file)) {
            return Storage::url($file->file); // Get the public URL for the file
        }
    
        // Return a placeholder image if the file doesn't exist or is invalid
        return asset('images/placeholder-image.jpg');
    }
    

    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }
    public function file(): MorphOne
    {
        return $this->morphOne(File::class, 'fileable');
    }


}
