<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\AcademicYear;

class UserMedicalRecords extends Component
{
    public function render()
    {

        $academicYears = AcademicYear::userRecord()->latest()->get();
        return view('livewire.user-medical-records',[
              'academicYears' => $academicYears,
        ]);
    }
}
