<?php

namespace App\Http\Controllers;

use App\Models\Regional;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegionalRequest;

class RegionalController extends Controller
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
            $regionals = Regional::whereYear('date', $year)
            ->orderBy('date', 'asc')
            ->paginate(10);
        } else {
            // Caso contrário, pega todos os gastos com o ano atual
            $year = \Carbon\Carbon::now()->year;
            $regionals = Regional::whereYear('date', $year)
            ->orderBy('date', 'asc')
            ->paginate(10);
        }

        // Obtém os anos disponíveis para o select
        $years = Regional::selectRaw('YEAR(date) as year')
            ->distinct()
            ->orderByDesc('year')->pluck('year', 'year');
        
        return view('regional.home', compact('regionals', 'years', 'year'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::orderBy('name', 'asc')->get();
        return view("regional.create", compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegionalRequest $request)
    {
        $data = $request->validated();
        // Convert 'string' to data
        $data['date'] = \Carbon\Carbon::createFromFormat('d/m/Y', $data['date'])->format('Y-m-d');
        //Para a data criada seja aquela que vai aparecer no .index
        $carbonDate = \Carbon\Carbon::parse($data['date']);
        $year = $carbonDate->year;  
        
        $data = Regional::create($data);
        if ($data) {
            session()->flash('success','Relatório adicionado com sucesso');
            return redirect()->route('regional.index', compact('year'));
        } else {
            session()->flash('error','Falha na criação');
            return redirect()->route('regional.create');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $regional = Regional::findOrFail($id);
        // Formatando a data que está em Y/m/d para d/m/Y, pois estou usando um input type text pra data
        $regional['date'] = \Carbon\Carbon::createFromFormat('Y-m-d', $regional['date'])->format('d/m/Y');

        $users = User::orderBy('name', 'asc')->get();
        
        return view('regional.edit', compact('regional', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RegionalRequest $request, $id)
    {
        $data = $request->validated();
        // Formatando a data que está em Y-m-d para d/m/Y
        $data['date'] = \Carbon\Carbon::createFromFormat('d/m/Y', $data['date'])->format('Y-m-d');
        //Para a data criada seja aquela que vai aparecer no .index
        $carbonDate = \Carbon\Carbon::parse($data['date']);
        $year = $carbonDate->year; 
        
        $regional = Regional::findOrFail($id);
        
        $input = $regional->update($data);
        if ($input) {
            session()->flash('success', 'Relatório atualizado com sucesso!');
            return redirect()->route('regional.index', compact('year'));
        } else {
            session()->flash('error','Falha na edição');
            return redirect()->route('regional.edit');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Regional::findOrFail($id);
        // Para a data criada seja aquela que vai aparecer no .index
        $carbonDate = \Carbon\Carbon::parse($data['date']);
        $year = $carbonDate->year; 

        $input = Regional::destroy($id);
        if ($input) {
            session()->flash('success', 'Relatório excluído com sucesso!');
            return redirect()->route('regional.index', compact('year'));
        } else {
            session()->flash('error', 'Erro na exclusão do Aluno');
            return redirect()->route('regional.index');
        }
    }
}
