<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\BloodPressureLevel;

class ViewBloodPreasureLevel extends Component
{   

    public BloodPressureLevel $record ;
    public function render()
    {
        return view('livewire.view-blood-preasure-level');
    }
}
