<?php

namespace App\Livewire\Symtoms;

use App\Models\Symptom;
use Livewire\Component;

class ViewSymptom extends Component
{   

    public Symptom $record;
    public function render()
    {
        return view('livewire.symtoms.view-symptom');
    }
}
