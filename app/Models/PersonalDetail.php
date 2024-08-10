<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PersonalDetail extends Model

{


    

    use HasFactory;
    public function personaldetailable(): MorphTo
    {
        return $this->morphTo();
    }

    public function getFormattedBirthdateAttribute()
    {
        return Carbon::parse($this->attributes['birth_date'])->format('F j, Y');
    }

    public function getImage()
    {
        if (!empty($this->image) && Storage::disk('public')->exists($this->image)) {
            return Storage::disk('public')->url($this->image);
        } else {
            return asset('images/placeholder-image.jpg'); // Return default image URL
        }
    }


    public function getFullName()
    {
        return ($this->first_name ?? '') . ($this->middle_name?? '') . '' . ($this->last_name ?? '') . '';
    }

    
}
