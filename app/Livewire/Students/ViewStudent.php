<?php

namespace App\Livewire\Students;

use App\Models\Student;
use Livewire\Component;

class ViewStudent extends Component
{   

    public Student $record;
    public function render()
    {
        return view('livewire.students.view-student');
    }
}
