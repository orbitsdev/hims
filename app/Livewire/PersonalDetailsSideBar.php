<?php

namespace App\Livewire;

use App\Models\EmergencyContact;
use Livewire\Component;

class PersonalDetailsSideBar extends Component
{
    public function render()
    {
        $emergencyContacts  = EmergencyContact::take(3)->get();
        return view('livewire.personal-details-side-bar',['emergencyContacts'=> $emergencyContacts]);
    }
}
