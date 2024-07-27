<?php

namespace App\Livewire\Condition;

use App\Models\Treatment;
use Livewire\Component;

class ViewTreatmentCondition extends Component
{   

    public Treatment $record;
    public function render()
    {
        return view('livewire.condition.view-treatment-condition');
    }
}
