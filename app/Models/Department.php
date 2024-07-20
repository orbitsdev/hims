<?php

namespace App\Models;

use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
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
}
