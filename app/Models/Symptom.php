<?php

namespace App\Models;

use App\Models\Condition;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Symptom extends Model
{
    use HasFactory;

    public function conditions()
    {
        return $this->belongsToMany(Condition::class, 'condition_symptom');
    }
}
