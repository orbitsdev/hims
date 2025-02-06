<?php

namespace App\Exports;

use App\Models\Staff;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class StaffExport implements FromView
{
    public function view(): View
    {
        $staff = Staff::with(['user', 'department', 'personalDetail'])->get();

        return view('exports.staff', compact('staff'));
    }
}
