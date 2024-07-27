<?php

namespace App\Models;

use App\Models\Symptom;
use App\Models\Condition;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ConditionSymptom extends Model
{
    use HasFactory;

    public function symptoms(){
        return $this->belongsTo(Symptom::class);
    }

    public function condition(){
        return $this->belongsTo(Condition::class);
    }
}
