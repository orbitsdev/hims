<?php

namespace App\Livewire;

use App\Models\MedicalRecord;
use Livewire\Component;

class PrintMedicalRecord extends Component
{

    public $record;

    public function mount(MedicalRecord $record){
        $this->record = $record;

    }
    public function render()
    {
        return view('livewire.print-medical-record',['record'=> $this->record]);
    }
}
