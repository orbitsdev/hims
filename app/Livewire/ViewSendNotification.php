<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class ViewSendNotification extends Component
{

    public User $record;
    public function render()
    {
        return view('livewire.view-send-notification');
    }
}
