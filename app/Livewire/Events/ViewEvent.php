<?php

namespace App\Livewire\Events;

use App\Models\Event;
use Livewire\Component;

class ViewEvent extends Component
{

    public Event $record;
    public function render()
    {
        return view('livewire.events.view-event');
    }
}
