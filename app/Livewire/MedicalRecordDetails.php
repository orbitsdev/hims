<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\MedicalRecord;

class MedicalRecordDetails extends Component
{

    public $medicalRecordId;
    public $medicalRecord;

    // Mount function to load medical record based on the passed ID
    public function mount($id)
    {
        $this->medicalRecordId = $id;
        $this->medicalRecord = MedicalRecord::findOrFail($id);
    }

    public function render()
    {

        
        return view('livewire.medical-record-details');
    }

}
