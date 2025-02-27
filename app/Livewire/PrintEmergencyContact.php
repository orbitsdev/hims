<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\EmergencyContact;

class PrintEmergencyContact extends Component
{
    public $contacts;

    public function mount()
    {
        // Fetch all emergency contacts
        $this->contacts = EmergencyContact::orderBy('name', 'asc')->get();
    }
    public function render()
    {
        return view('livewire.print-emergency-contact',[
            'contacts' => $this->contacts
        ]);
    }
}
