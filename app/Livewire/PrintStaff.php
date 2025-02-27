<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Staff;

class PrintStaff extends Component
{
    public $record;

    public function mount($record)
    {
        // Ensure department relationship is loaded
        $this->record = Staff::with('department')->findOrFail($record);
    }

    public function render()
    {
        return view('livewire.print-staff');
    }
}
