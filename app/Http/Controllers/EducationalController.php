<?php

namespace App\Http\Controllers;

use App\Models\Educational;
use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests\EducationalRequest;

class EducationalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Pega o ano passado como parâmetro na requisição
        $year = request('year');

        // Se o ano for fornecido, filtra os gastos por year
        if ($year) {
            $pedagogicals = Educational::whereYear('date_pedagogical', $year)
            ->orderBy('date_pedagogical', 'desc')
            ->paginate(15);
        } else {
            // Caso contrário, pega todos os gastos com o ano atual
            $year = Carbon::now()->year;
            $pedagogicals = Educational::whereYear('date_pedagogical', $year)
            ->orderBy('date_pedagogical', 'desc')
            ->paginate(15);
        }

        // Obtém os anos disponíveis para o select
        $years = Educational::selectRaw('YEAR(date_pedagogical) as year')
            ->distinct()
            ->orderByDesc('year')->pluck('year', 'year');
        
        return view('educational.home', compact('pedagogicals', 'years', 'year'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::where('state_student', 'alive')
        ->orderBy('name', 'asc')
        ->get();
        $users = User::orderBy('name', 'asc')->get();
        return view("educational.create", compact('students', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EducationalRequest $request)
    {   
        $data = $request->validated();
        // Convert string to data
        $data['date_pedagogical'] = Carbon::createFromFormat('d/m/Y', $data['date_pedagogical'])->format('Y-m-d');

        $input = Educational::create($data);
        if ($input) {
            session()->flash('success', 'Relatório Pedagógico adicionado com sucesso');
            return redirect()->route('educational.index');
        } else {
            session()->flash('error', 'Falha na criação do Relatório Pedagógico');
            return redirect()->route('educational.create');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pedagogical = Educational::findOrFail($id);
        $pedagogical['date_pedagogical'] = Carbon::createFromFormat('Y-m-d', $pedagogical['date_pedagogical'])->format('d/m/Y');

        return view('educational.show', compact('pedagogical'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pedagogical = Educational::with('student')->findOrFail($id);

        $students = Student::where('state_student', 'alive')
        ->orderBy('name', 'asc')
        ->get();
        $users = User::orderBy('name', 'asc')->get();

        //Convert data to string
        $pedagogical['date_pedagogical'] = Carbon::createFromFormat('Y-m-d', $pedagogical['date_pedagogical'])->format('d/m/Y');

        return view('educational.edit', compact('pedagogical', 'students', 'users')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EducationalRequest $request, $id)
    {
        $pedagogical = Educational::findOrFail($id);
        $data = $request->validated();
        // Convert string to data
        $data['date_pedagogical'] = Carbon::createFromFormat('d/m/Y', $data['date_pedagogical'])->format('Y-m-d');

        $input = $pedagogical->update($data);
        
        if ($input) {
            session()->flash('success', 'Relatório Pedagógico atualizado com sucesso!');
            return redirect()->route('educational.index');
        } else {
            session()->flash('error', 'Falha na edição do Relatório Pedagógico');
            return redirect()->route('educational.edit');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $input = Educational::destroy($id);

        if ($input) {
            session()->flash('success', 'Relatório Pedagógico excluído com sucesso!');
            return redirect()->route('educational.index');
        } else {
            session()->flash('error', 'Erro na exclusão do Relatório Pedagógico');
            return redirect()->route('educational.index');
        }
    }
}
