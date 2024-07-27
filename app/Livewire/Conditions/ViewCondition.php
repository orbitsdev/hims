<?php

namespace App\Livewire\Conditions;

use App\Models\Condition;
use Livewire\Component;

class ViewCondition extends Component
{   

    public Condition $record;
    public function render()
    {
        return view('livewire.conditions.view-condition');
    }
}
