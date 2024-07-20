<?php

namespace App\Models;

use App\Models\User;
use App\Models\PersonalDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Personnel extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function personalDetail(): MorphOne
    {
        return $this->morphOne(PersonalDetail::class, 'personaldetailable');
    }
}
