<?php

namespace App\Models;

use App\Models\Semester;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcademicYear extends Model
{
    use HasFactory;

    public function semesters(){
        return $this->hasMany(Semester::class);
    }

    public static function suggestion(){
        $currentYear = date('Y');
        $nextYear = $currentYear + 1;
    
        return "{$currentYear}-{$nextYear}";
    }
}
