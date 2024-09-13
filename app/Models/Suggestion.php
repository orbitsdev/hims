<?php

namespace App\Models;

use App\Models\BloodPressureLevel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Suggestion extends Model
{
    use HasFactory;

    public function bloodPressureLevel()
    {
        return $this->belongsTo(BloodPressureLevel::class);
    }
}
