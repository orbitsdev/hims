<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\EmergencyContact;

class PublicEmergencyContact extends Component
{

    use WithPagination;
    public $search = '';

    public function updatingSearch()
    {
        // Reset the pagination when search changes
        $this->resetPage();
    }

    public function render()
    {
        // Filter emergency contacts based on search input
        $emergencyContacts = EmergencyContact::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('contact', 'like', '%' . $this->search . '%')
            ->orWhere('address', 'like', '%' . $this->search . '%')
            ->paginate(10);

        return view('livewire.public-emergency-contact', [
            'emergencyContacts' => $emergencyContacts,
        ]);
    }
}
