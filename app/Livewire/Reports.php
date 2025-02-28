<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\EmergencyContact;

class Reports extends Component
{


    public $contacts;

    public function mount(){
        $this->contacts = EmergencyContact::orderBy('name', 'asc')->get();
    }


    public function render()
    {
        return view('livewire.reports');
    }
}
