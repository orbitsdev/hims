<?php

namespace App\Livewire;

use App\Models\Student;
use Livewire\Component;

class PrintStudentDetails extends Component
{
    public $record;

    public function mount(Student $record)
    {
        $this->record = $record;
    }

    public function render()
    {
        return view('livewire.print-student-details', [
            'record' => $this->record,
        ]);
    }
}
