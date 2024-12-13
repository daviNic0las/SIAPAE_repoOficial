<?php

namespace App\Listeners;

use App\Events\StudentUpdated;
use App\Models\Frequency;
use App\Models\Student;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateFrequencyList
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(StudentUpdated $event): void
    {
        $actual_month_year = \Carbon\Carbon::now()->format('m/Y');
        $frequency = Frequency::where('student_name', $event->oldName)
            ->where('month_year', $actual_month_year)
            ->first();

        $frequency->student_name = $event->student->name; 
        $frequency->class_apae = $event->student->class_apae; 
        $frequency->turn_apae = $event->student->turn_apae; 
        $frequency->save();
    }
}
