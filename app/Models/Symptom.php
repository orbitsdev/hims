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
        // Retrieve the related file using the morphOne relationship
        $file = $this->file;
    
        // Ensure the file exists and its 'file' attribute is valid
        if ($file && !empty($file->file) && is_string($file->file) && Storage::disk('public')->exists($file->file)) {
            return Storage::url($file->file); // Return the public URL for the file
        }
    
        // Fallback to a placeholder image if no valid file is found
        return asset('images/placeholder-image.jpg');
    }

}
