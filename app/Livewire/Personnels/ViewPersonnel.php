<?php

namespace App\Livewire\Personnels;

use App\Models\Personnel;
use Livewire\Component;

class ViewPersonnel extends Component
{

    public Personnel $record;
    public function render()
    {
        return view('livewire.personnels.view-personnel');
    }
}
