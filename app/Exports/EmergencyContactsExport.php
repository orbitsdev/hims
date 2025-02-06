<?php

namespace App\Exports;

use App\Models\EmergencyContact;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class EmergencyContactsExport implements FromView
{
    public function view(): View
    {
        $contacts = EmergencyContact::all();

        return view('exports.emergency_contacts', compact('contacts'));
    }
}
