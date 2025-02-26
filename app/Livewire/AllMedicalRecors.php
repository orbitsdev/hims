<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class AllMedicalRecors extends Component
{

    public $record;
    public function mount(User $record){
        $this->record = $record;
    }
    public function render()
    {
        return view('livewire.all-medical-recors',['record'=> $this->record]);
    }
}
