<?php

namespace App\Http\Controllers;

use Faker\Provider\Medical;
use Illuminate\Http\Request;

use App\Models\MedicalRecord;

use Spatie\LaravelPdf\Facades\Pdf;
use Illuminate\Support\Facades\Storage;
use function Spatie\LaravelPdf\Support\pdf;

class ReportController extends Controller
{
    
    public function viewMedicalReport(MedicalRecord $record){
         //  $record = MedicalRecord::first();

    return view('reports.medical-report-view',['record'=> $record]);


   
    }
    public function generatePdf(MedicalRecord $record)
{       
    //  $record = MedicalRecord::first();
    $filename = $record->fullName(). '-'. $record->record->academicYearAndSemester().'-MEDICAL-RECORD.pdf';
    $public_path = public_path($filename);
    Pdf::view('reports.medical-report',['record'=> $record])->save($public_path);


    return response()->download($public_path)->deleteFileAfterSend(true);
    
}

}
