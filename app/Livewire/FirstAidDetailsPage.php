<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Condition;

class FirstAidDetailsPage extends Component
{
    public $condition;

    public function mount($id)
    {
        // Fetch the condition with treatments and first aid guides
        $this->condition = Condition::with(['treatments', 'firstAidGuides', 'file'])->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.first-aid-details-page', [
            'condition' => $this->condition,
        ]);
    }
}
