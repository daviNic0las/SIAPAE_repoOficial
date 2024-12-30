<?php

namespace App\Http\Controllers;

use App\Models\Frequency;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FrequencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $professors = User::where('position', 'professor(a)')
            ->where('state_user', 'alive')
            ->orderBy('name', 'asc')
            ->get();

        $class_apae = request('class_apae');
        $turn_apae = request('turn_apae');
        $monthYear = request('monthYear');

        if ($class_apae && $turn_apae && $monthYear) {
            $frequencies = Frequency::join('students', 'frequencies.student_id', '=', 'students.id')->
                select('frequencies.*')->
                where('students.class_apae', $class_apae)->
                where('students.turn_apae', $turn_apae)->
                where('frequencies.month_year', $monthYear)->
                with('student')->
                orderBy('students.name', 'asc')->
                paginate(15);

        } elseif ($class_apae && $monthYear) {
            $frequencies = Frequency::join('students', 'frequencies.student_id', '=', 'students.id')->
                select('frequencies.*')->
                where('students.class_apae', $class_apae)->
                where('frequencies.month_year', $monthYear)->
                with('student')->
                orderBy('students.name', 'asc')->
                paginate(15);
        } elseif ($turn_apae && $monthYear) {
            $frequencies = Frequency::join('students', 'frequencies.student_id', '=', 'students.id')->
                select('frequencies.*')->
                where('students.turn_apae', $turn_apae)->
                where('frequencies.month_year', $monthYear)->
                with('student')->
                orderBy('students.name', 'asc')->
                paginate(15);
        } elseif ($monthYear) {
            $frequencies = Frequency::join('students', 'frequencies.student_id', '=', 'students.id')->
                select('frequencies.*')->
                where('frequencies.month_year', $monthYear)->
                with('student')->
                orderBy('students.name', 'asc')->
                paginate(15);
        } else {

            $horaLocal = Carbon::now('America/Sao_Paulo')->format('H');
            if ($horaLocal <= 12) {
                $turn_apae = 'Manhã';
            } else {
                $turn_apae = 'Tarde';
            }

            $monthYear = Carbon::now()->format('m/Y');

            $diaSemanaNumero = Carbon::now()->dayOfWeek;
            if ($diaSemanaNumero == 1 || $diaSemanaNumero == 3) {
                $class_apae = "Segunda e Quarta";
            } elseif ($diaSemanaNumero == 2 || $diaSemanaNumero == 4) {
                $class_apae = "Terça e Quinta";
            } elseif ($diaSemanaNumero == 5) {
                $class_apae = "Sexta";
            } else {
            }

            $frequencies = Frequency::join('students', 'frequencies.student_id', '=', 'students.id')->
                select('frequencies.*')->
                where('students.class_apae', $class_apae)->
                where('students.turn_apae', $turn_apae)->
                where('frequencies.month_year', $monthYear)->
                with('student')->
                orderBy('students.name', 'asc')->
                paginate(15);

            if ($diaSemanaNumero == 0 || $diaSemanaNumero == 6) {
                //Caso seja sabado (6) ou domingo (0), substitua a pesquisa apenas pelo mês/ano
                $class_apae = '';
                $turn_apae = '';
                $frequencies = Frequency::join('students', 'frequencies.student_id', '=', 'students.id')->
                    select('frequencies.*')->
                    where('frequencies.month_year', $monthYear)->
                    with('student')->
                    orderBy('students.name', 'asc')->
                    paginate(15);
            }
        }

        //Para funcionar a gambiarra já que cada aluno tem a sua observação e assinatura na coluna
        $observation = null;
        $signature = null;

        // Loop através dos elementos para encontrar as observações e assinaturas
        for ($i = 0; $i < count($frequencies) - 1; $i++) {
            $currentElement = $frequencies[$i];
            $nextElement = $frequencies[$i + 1] ?? null;

            // Verifica se as observações do elemento atual e o próximo são iguais
            if ($currentElement['observation'] == $nextElement['observation']) {
                $observation = $currentElement['observation'] ?? null;
                $signature = $nextElement['signature'] ?? null;
                break;  // Encontrou uma correspondência, podemos sair do loop
            }
        }
        if (!$frequencies[1]) {
            $observation = $frequencies[0]['observation'] ?? null;
            $signature = $frequencies[0]['signature'] ?? null;
        }

        // Para contar a quantidade de dias do mês pesquisado ou atual (caso não haja valor no input) 
        list($month, $year) = explode('/', $monthYear);
        $month = (int) $month;
        $year = (int) $year;
        $numberDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        // Cria uma lista de dias para o mês, formatando-os para ter 1 zero a esquerda em números não decimais 
        $days = [];
        for ($i = 1; $i <= $numberDaysInMonth; $i++) {
            $days[] = str_pad($i, 2, '0', STR_PAD_LEFT);
        }

        // Definir os feriados / finais de semanas  
        $holidays = [
            '01-01', // Ano Novo 
            '21-04', // Tiradentes
            '01-05', // Dia do Trabalho
            '07-09', // Independência do Brasil
            '12-10', // Nossa Senhora Aparecida
            '02-11', // Finados
            '15-11', // Proclamação da República
            '20-11', // Dia Nacional de Zumbi e da Consciência Negra
            '25-12', // Natal 
        ];
        $formattedHolidays = array_map(function ($holiday) use ($year) {
            return "{$year}-{$holiday}";
        }, $holidays); 

        $weekends = []; 
        for ($i = 1; $i <= $numberDaysInMonth; $i++) { 
            $date = sprintf("%04d-%02d-%02d", $year, $month, $i); 
            $dayOfWeek = date('N', strtotime($date)); 
            if ($dayOfWeek == 6 || $dayOfWeek == 7) { 
                $weekends[] = $date; 
            } 
        }
        $nonClickableDays = array_merge($formattedHolidays, $weekends);

        // Calcular as faltas para cada frequência 
        foreach ($frequencies as $frequency) { 
            $countAbsences = 0; 
            for ($day = 1; $day <= $numberDaysInMonth; $day++) { 
                $date = sprintf("%04d-%02d-%02d", $year, $month, $day); 
                if (!in_array($date, $nonClickableDays) && $frequency->$day == 0) 
                { 
                    $countAbsences++; 
                } 
            } 
            $frequency->countAbsences = $countAbsences; 
        }

        return view('frequencyF.home', compact('frequencies', 'professors', 'class_apae', 'turn_apae', 'monthYear', 'days', 'numberDaysInMonth', 'nonClickableDays', 'observation', 'signature'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('errors.404');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Frequency $frequency)
    {
        return view('errors.404');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Frequency $frequency)
    {
        return view('errors.404');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validação dos dados
        $request->validate([
            'frequencyId' => 'required',
            'day' => 'required',
            'status' => 'required|boolean',
        ]);

        // Encontrar o aluno
        $frequency = Frequency::find($id);

        if (!$frequency) {
            return response()->json(['success' => false, 'message' => 'Aluno da frequência não encontrado.']);
        }

        $frequency->{$request->day} = $request->status;
        $frequency->save();

        return response()->json(['success' => true]);
    }

    public function updateDetails(Request $request)
    {
        // Decodifique o JSON recebido
        $frequencies = json_decode($request->input('frequencies'), true);
        $observation = $request->input('observation');
        $signature = $request->input('signature');
        $class_apae = null;
        $turn_apae = null;
        $monthYear = null;

        DB::transaction(function () use ($frequencies, $observation, $signature, &$class_apae, &$turn_apae, &$monthYear) {
            foreach ($frequencies['data'] as $frequencyData) {
                $frequency = Frequency::find($frequencyData['id']);
                if ($frequency) {
                    if($observation == '') {
                        $observation = '-------- Sem Observações --------';
                    }
                    $updated = $frequency->update([
                        'observation' => $observation, // Atualize conforme necessário
                        'signature' => $signature, // Assinatura comum para todos
                    ]);
                    if (!$updated) {
                        throw new \Exception("Falha ao atualizar a frequência com ID {$frequencyData['id']}");
                    }
                } else {
                    throw new \Exception("Frequência com ID {$frequencyData['id']} não encontrada");
                }
                $class_apae = $frequency->student->class_apae;
                $turn_apae = $frequency->student->turn_apae;
                $monthYear = $frequency->month_year;
            }
        });
        // Se a transação for bem-sucedida, retornamos com uma mensagem de sucesso
        session()->flash('success', 'Observações atualizadas com sucesso!');
        return redirect()->route('frequency.index', compact('class_apae', 'turn_apae', 'monthYear'));
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Frequency $frequency)
    {
        //
    }
    public function generatePdf($id)
    {

    }
}
