<?php

namespace App\Livewire;

use App\Models\Event;
use App\Models\Record;
use Livewire\Component;
use App\Models\AcademicYear;
use Livewire\WithPagination;

class EventList extends Component
{
    use WithPagination;

    public $perPage = 10;

    protected $listeners = ['loadMore'];

    public function loadMore()
    {
        $this->perPage += 10;
    }

    public function render()
    {

        $events = Event::where('is_published', true)
            ->orderBy('event_date', 'desc')
            ->paginate($this->perPage);


            $academicYears = AcademicYear::userRecord()->get();





        return view('livewire.event-list', [
            'events' => $events,
            'academicYears' => $academicYears,
        ]);
    }
}
