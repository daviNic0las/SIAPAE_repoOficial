<?php

namespace App\Http\Controllers;

use App\Models\Diagnostic;
use App\Http\Controllers\Controller;
use App\Http\Requests\DiagnosticRequest;

class DiagnosticController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $diagnostics = Diagnostic::orderBy('id', 'asc')->get();
        return view('diagnostic.home', compact('diagnostics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $categories = Diagnostic::all();
        return view('diagnostic.create');
    }

    public function store(DiagnosticRequest $request)
    {
        
        $data = $request->validated();
        // dd($data);
        $data = Diagnostic::create($data);
        if ($data) {
            session()->flash('success','Categoria adicionada com sucesso');
            return redirect()->route('diagnostic.index');
        } else {
            session()->flash('error','Falha na criação');
            return redirect()->route('diagnostic.create');
        }
    }

    public function edit($id)
    {
        $diagnostic = Diagnostic::findOrFail($id);
        return view('diagnostic.edit', compact('diagnostic'));
    }

    public function update(DiagnosticRequest $request, $id)
    {
        $data = $request->validated();

        $diagnostic = Diagnostic::findOrFail($id);
        
        // $name = $request->name;
        // $diagnostic->name = $name;

        $input = $diagnostic->update($data);
        if ($input) {
            session()->flash('success', 'Diagnóstico atualizado com sucesso!');
            return redirect()->route('diagnostic.index');
        } else {
            session()->flash('error','Falha na edição');
            return redirect()->route('diagnostic.edit');
        }
    }

    public function destroy($id)
    {
        $input = Diagnostic::findOrFail($id)->delete();
        if ($input) {
            session()->flash('success', 'Categoria excluída com sucesso!');
            return redirect()->route('diagnostic.index');
        } else {
            session()->flash('error', 'Erro na exclusão do item');
            return redirect()->route('diagnostic.index');
        }
    }
}
