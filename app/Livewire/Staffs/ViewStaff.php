<?php

namespace App\Livewire\Staffs;

use App\Models\Staff;
use Livewire\Component;

class ViewStaff extends Component
{

    public Staff $record;
    public function render()
    {
        return view('livewire.staffs.view-staff');
    }
}
