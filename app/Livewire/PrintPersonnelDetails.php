<?php

namespace App\Livewire;

use App\Models\Personnel;
use Livewire\Component;

class PrintPersonnelDetails extends Component
{
    public $record;

    public function mount(Personnel $record)
    {
        $this->record = $record->load('user', 'department');
    }

    public function render()
    {
        return view('livewire.print-personnel-details', [
            'record' => $this->record,
        ]);
    }
}
