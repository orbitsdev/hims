<?php

namespace App\Observers;

use App\Models\Student;
use Illuminate\Support\Str;
class StudentObserver
{
    /**
     * Handle the Student "created" event.
     */
    public function created(Student $student): void
    {
        $uuid = str_replace('-', '', Str::orderedUuid());

        // Shuffle the characters and convert to title case to ensure a combination of uppercase and lowercase characters
        $shuffledUuid = mb_convert_case(str_shuffle($uuid), MB_CASE_TITLE);

        // Ensure the shuffled UUID is exactly 12 characters long
        $shuffledUuid = str_pad(substr($shuffledUuid, 0, 12), 12, '0', STR_PAD_RIGHT);

        $student->unique_id = $shuffledUuid; // Assign the shuffled UUID to the account's unique_id

        $student->save();
        //
    }

    /**
     * Handle the Student "updated" event.
     */
    public function updated(Student $student): void
    {
        //
    }

    /**
     * Handle the Student "deleted" event.
     */
    public function deleted(Student $student): void
    {
        //
    }

    /**
     * Handle the Student "restored" event.
     */
    public function restored(Student $student): void
    {
        //
    }

    /**
     * Handle the Student "force deleted" event.
     */
    public function forceDeleted(Student $student): void
    {
        //
    }
}
