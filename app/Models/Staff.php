<?php

namespace App\Models;

use App\Models\User;
use App\Models\Department;
use App\Models\PersonalDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Staff extends Model
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
        if (!empty($this->photo) && Storage::disk('public')->exists($this->photo)) {
            return Storage::disk('public')->url($this->photo);
        } else {
            return url('images/placeholder-image.jpg'); // Return default image URL
        }
    }

    public function department(){
        return $this->belongsTo(Department::class);

    }
}
