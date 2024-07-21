<?php

namespace App\Observers;

use App\Models\AcademicYear;

class AcademicYearObserver
{
    /**
     * Handle the AcademicYear "created" event.
     */
    public function created(AcademicYear $academicYear): void
    {
        $semesters = [
            [
                'name_in_text' => 'First Semester',
                'name_in_number' => '1st Semester',
            ],
            [
                'name_in_text' => 'Second Semester',
                'name_in_number' => '2nd Semester',
            ],
        ];

        foreach ($semesters as $semester) {
            $academicYear->semesters()->create($semester);
        }
    }   

    /**
     * Handle the AcademicYear "updated" event.
     */
    public function updated(AcademicYear $academicYear): void
    {
        //
    }

    /**
     * Handle the AcademicYear "deleted" event.
     */
    public function deleted(AcademicYear $academicYear): void
    {
        //
    }

    /**
     * Handle the AcademicYear "restored" event.
     */
    public function restored(AcademicYear $academicYear): void
    {
        //
    }

    /**
     * Handle the AcademicYear "force deleted" event.
     */
    public function forceDeleted(AcademicYear $academicYear): void
    {
        //
    }
}
