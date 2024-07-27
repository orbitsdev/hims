<?php

namespace App\Models;

use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;


    const CCS = 'COLLEGE OF COMPUTER STUDY (CCS)';
    const NABA = 'COLLEGE OF INDUSTRIAL TECHNOLOGY (NBA)';
    const ESO = 'ENGINEERING STUDENTS ORGANIZATION (ESO)';

    const LIST = [
        //   User::ADMIN => User::ADMIN, 
          Department::CCS => Department::CCS, 
          Department::NABA => Department::NABA, 
          Department::ESO => Department::ESO, 
          
        ];

    public function students(){
        return $this->hasMany(Student::class);
    }

    public function getImage()
    {
        if (!empty($this->image) && Storage::disk('public')->exists($this->image)) {
            return Storage::disk('public')->url($this->image);
        } else {
            return asset('images/placeholder-image.jpg'); // Return default image URL
        }
    }

    public function getNameWithAbbreviation()
    {
        $name = $this->name ?? '';
    $abbreviation = $this->abbreviation ? ' (' . $this->abbreviation . ')' : '';
    
    return $name . $abbreviation;
    }
    
}
