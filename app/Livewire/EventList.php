<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;
use App\Models\AcademicYear;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class EventList extends Component
{
    use WithPagination;

    // public $perPage = 10;

    // Using the #[On] attribute to listen for 'loadMore' event
    // #[On('loadMore')]
    // public function loadMore()
    // {
    //     $this->perPage += 10;
    // }

    public function render()
    {
        $events = Event::where('is_published', true)
        ->latest()
            ->orderBy('event_date', 'desc')
            ->get();

        // $academicYears = AcademicYear::userRecord()->latest()->get();

        return view('livewire.event-list', [
            'events' => $events,
            // 'academicYears' => $academicYears,
        ]);
    }
}
