<?php

namespace App\Models;

use App\Models\File;
use App\Models\Condition;
use App\Models\ConditionSymptom;
use Illuminate\Database\Eloquent\Model;
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


}
