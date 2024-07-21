<?php

namespace App\Models;

use App\Models\Semester;
use App\Models\AcademicYear;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    public function academicYear(){
        return $this->belongsTo(AcademicYear::class);
    
    }
    public function semester(){
        return $this->belongsTo(Semester::class);
    
    }
}
