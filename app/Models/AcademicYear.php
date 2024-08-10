<?php

namespace App\Models;

use App\Models\Event;
use App\Models\Record;
use App\Models\Semester;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcademicYear extends Model
{
    use HasFactory;

    public function semesters(){
        return $this->hasMany(Semester::class);
    }
    public function records(){
        return $this->hasMany(Record::class);
    }
    public function events(){
        return $this->hasMany(Event::class);
    }

    public static function suggestion(){
        $currentYear = date('Y');
        $nextYear = $currentYear + 1;
    
        return "{$currentYear}-{$nextYear}";
    }


    public function scopeWithSemesterWithoutRecord($query)
    {
        return $query->whereHas('semesters', function ($query) {
            $query->whereDoesntHave('record');
        });
    }

    public function scopeHasRecords($query){
        return $query->whereHas('records');
    }
    public function scopeHasEvents($query){
        return $query->whereHas('events');
    }
}
