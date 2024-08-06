<?php

namespace App\Models;

use App\Models\Event;
use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DepartmentEvent extends Model
{
    use HasFactory;

    public function department(){
        return $this->belongsTo(Department::class);
    }
    public function event(){
        return $this->belongsTo(Event::class);
    }
}
