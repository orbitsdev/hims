<?php

namespace App\Exports;

use App\Models\Personnel;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class PersonnelsExport implements FromView
{
    public function view(): View
    {
        $personnels = Personnel::with(['user', 'department'])->get();

        return view('exports.personnels', compact('personnels'));
    }
}
