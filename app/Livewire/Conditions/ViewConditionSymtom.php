<?php

namespace App\Livewire\Conditions;

use App\Models\Symptom;
use Livewire\Component;

class ViewConditionSymtom extends Component
{

    public Symptom $record;
    public function render()
    {
        return view('livewire.conditions.view-condition-symtom');
    }
}
