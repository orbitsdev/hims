<?php

namespace App\Exports;

use App\Models\Event;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class EventsExport implements FromView
{
    public function view(): View
    {
        $events = Event::with(['user', 'academicYear', 'semester'])->get();

        return view('exports.events', compact('events'));
    }
}
