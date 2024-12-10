<?php

namespace App\Listeners;

use App\Events\StudentCreated;
use App\Models\Frequency;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateFrequencyList
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
    public function handle(StudentCreated $event): void
    {
        Frequency::create([ 
            'student_name' => $event->student->name, 
            'class_apae' => $event->student->class_apae,
            'turn_apae' => $event->student->turn_apae,
            'month_year' => \Carbon\Carbon::now()->format('m/Y')
        // Outros campos da tabela de doações, que serão vazios por padrão 
        ]); 

        // $frequencyList = new Frequency();
        // $frequencyList->student_id = $event->student->id;
        // // Outras propriedades podem ser configuradas dependendo da sua estrutura de dados
        // $frequencyList->save();
    }
}
