<?php

namespace App\Models;

use App\Models\File;
use App\Models\Condition;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FirstAidGuide extends Model
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
        $file = $this->file;
    
        // Check if a file exists and if the file path is valid
        if ($file && !empty($file->file) && Storage::disk('public')->exists($file->file)) {
            return Storage::disk('public')->url($file->file);
        }
    
       
        return asset('images/placeholder-image.jpg');
    }
    
    public function condition(){
        return $this->belongsTo(Condition::class);
    }
}
