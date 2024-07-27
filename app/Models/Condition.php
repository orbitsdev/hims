<?php

namespace App\Models;

use App\Models\File;
use App\Models\Symptom;
use App\Models\Treatment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphOne;

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
        return $this->hasMany(Treatment::class);
    }

    public function symptoms()
    {
        return $this->belongsToMany(Symptom::class, 'condition_symptom');
    }
}
