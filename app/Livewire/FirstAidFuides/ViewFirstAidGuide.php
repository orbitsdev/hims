<?php

namespace App\Livewire\FirstAidFuides;

use App\Models\FirstAidGuide;
use Livewire\Component;

class ViewFirstAidGuide extends Component

{

    public FirstAidGuide $record;
    public function render()
    {
        return view('livewire.first-aid-fuides.view-first-aid-guide');
    }
}
