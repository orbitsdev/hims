<?php

namespace App\Models;

use App\Models\User;
use App\Models\PersonalDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Personnel extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function personalDetail(): MorphOne
    {
        return $this->morphOne(PersonalDetail::class, 'personaldetailable');
    }

    public function getImage()
    {
        if (!empty($this->image) && Storage::disk('public')->exists($this->image)) {
            return Storage::disk('public')->url($this->image);
        } else {
            return asset('images/placeholder-image.jpg'); // Return default image URL
        }
    }
}
