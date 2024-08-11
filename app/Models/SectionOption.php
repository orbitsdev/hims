<?php

namespace App\Models;

use App\Models\Section;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SectionOption extends Model
{
    use HasFactory;

    public function section(){
        return $this->belongsTo(Section::class);
    }
}
