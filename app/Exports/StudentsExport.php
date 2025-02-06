<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class StudentsExport implements FromView
{
    public function view(): View
    {
        $students = Student::with(['user', 'course', 'section', 'department', 'personalDetail'])->get();

        return view('exports.students', compact('students'));
    }
}
