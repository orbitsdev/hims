<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MedicalController extends Controller
{
    public static function automaticChangeStatus($record){
        $count = User::query()
            ->notAdmin()
            ->notStaff()
            ->hasPersonalDetails()
            ->noRecordInThisAcademicYearAndSemester($record)
            ->count();        
    
        if ($count == 0) {  
            $record->status = true;  
        } else {
            // if ($record->status) {  
            //     $record->status = false;  
                
            // }
        }
        $record->save();
    }
}
