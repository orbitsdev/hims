<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Faker\Provider\Medical;

use App\Exports\StaffExport;

use Illuminate\Http\Request;
use App\Exports\EventsExport;
use App\Models\FirstAidGuide;
use App\Models\MedicalRecord;
use App\Exports\StudentsExport;
use App\Exports\PersonnelsExport;
use Spatie\LaravelPdf\Facades\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use App\Exports\EmergencyContactsExport;
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

    $staffMembers = Staff::whereHas('department', function($query){
            $query->where('role', 'Staff');
    })
    ->where('status', true)
    ->with(['department']) // Only active staff
    ->get();

    Pdf::view('reports.medical-report',['record'=> $record, 'staffMembers' =>$staffMembers])->save($public_path);


    return response()->download($public_path)->deleteFileAfterSend(true);

}

public function generateFirstAidPdf(FirstAidGuide $guide)
{
    if (!$guide) {
        return redirect()->back()->with('error', 'First Aid Guide not found.');
    }

    $guide->load(['condition.treatments']);

    $filename = str_replace(' ', '_', $guide->title) . '-FIRST-AID-GUIDE.pdf';
    $public_path = public_path($filename);

    Pdf::view('reports.first-aid-guide', compact('guide'))->save($public_path);

    return response()->download($public_path)->deleteFileAfterSend(true);
}

public function exportStudents()
    {
        $filename = 'Students_' . now()->format('Y-m-d') . '.xlsx';
        return Excel::download(new StudentsExport(), $filename);
    }


    public function exportStaff()
    {
        $filename = 'Staff_' . now()->format('Y-m-d') . '.xlsx';
        return Excel::download(new StaffExport(), $filename);
    }
    public function exportEvents()
    {
        $filename = 'Events_' . now()->format('Y-m-d') . '.xlsx';
        return Excel::download(new EventsExport(), $filename);
    }

    public function exportPersonnels()
    {
        $filename = 'Personnels_' . now()->format('Y-m-d') . '.xlsx';
        return Excel::download(new PersonnelsExport(), $filename);
    }

    public function exportEmergencyContacts()
    {
        $filename = 'Emergency_Contacts_' . now()->format('Y-m-d') . '.xlsx';
        return Excel::download(new EmergencyContactsExport(), $filename);
    }


}
