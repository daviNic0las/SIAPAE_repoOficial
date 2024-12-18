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
        $users = User::orderBy('name', 'asc')->get();

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

        //Gambiarra: Peguei a observação e assinatura do primeiro elemento que aparecer na tabela
        $primaryElement = $frequencies[0];
        $observation = $primaryElement['observation'] ?? null;
        $signature = $primaryElement['signature'] ?? null;

        // Para contar a quantidade de dias do mês pesquisado ou atual (caso não haja valor no input) 
        list($month, $year) = explode('/', $monthYear);
        $month = (int) $month;
        $year = (int) $year;
        $numberDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        // // Cria uma lista de dias para o mês, formatando-os para ter 1 zero a esquerda em números não decimais 
        $days = [];
        for ($i = 1; $i <= $numberDaysInMonth; $i++) {
            $days[] = str_pad($i, 2, '0', STR_PAD_LEFT);
        }

        return view('frequencyF.home', compact('frequencies', 'users', 'class_apae', 'turn_apae', 'monthYear', 'days', 'numberDaysInMonth', 'observation', 'signature'));
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

        DB::transaction(function () use ($frequencies, $observation, $signature) {
            foreach ($frequencies['data'] as $frequencyData) {
                $frequency = Frequency::find($frequencyData['id']);
                if ($frequency) {
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
        }
        });
        // Se a transação for bem-sucedida, retornamos com uma mensagem de sucesso
        session()->flash('success', 'Observações atualizadas com sucesso!');
        return redirect()->route('frequency.index');
    } 
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Frequency $frequency)
    {
        //
    }
}
