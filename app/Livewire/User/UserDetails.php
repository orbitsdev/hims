<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;

class UserDetails extends Component

{

    public User $record;
    public function render()
    {
        return view('livewire.user.user-details');
    }
}
