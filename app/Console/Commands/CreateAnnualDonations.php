<?php

namespace App\Console\Commands;

use App\Models\Donation;
use App\Models\Student;
use Illuminate\Console\Command;

class CreateAnnualDonations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-annual-donations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Criar uma nova linha de doação para cada estudante de acordo com o ano atual, se o ano atual não estiver registrado no BD, logo, crie outra linha para cada estudante existente';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Pega todos os usuários
        $students = Student::all();

        foreach ($students as $student) {
            // Verifica se o usuário já tem uma doação no ano atual
            $anoAtual = \Carbon\Carbon::now()->year;
            $doacaoExistente = Donation::where('student_id', $student->id)
                ->where('year_of_donation', $anoAtual)
                ->exists();
            
            // Se não tiver, cria uma nova doação
            if (!$doacaoExistente) {
                Donation::create([
                    'student_id' => $student->id,
                    'year_of_donation' => $anoAtual,
                ]);
                $this->info("Doação criada para o usuário {$student->id} no ano {$anoAtual}.");
            } else {
                $this->info("O usuário {$student->id} já tem uma doação para o ano {$anoAtual}.");
            }
        }
    }
}
