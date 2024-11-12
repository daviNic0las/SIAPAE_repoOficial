<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExpenseRequest;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expenses = Expense::orderBy('id', 'asc')->get();
        return view('expense.home', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("expense.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExpenseRequest $request)
    {
        $data = $request->validated();
        // Convert 'string' to data
        $data['date_of_emission'] = \Carbon\Carbon::createFromFormat('d/m/Y', $data['date_of_emission'])->format('Y-m-d');
        //Convert 'price'
        $preco = $data['price'];
        $precoDecimal = preg_replace('/\D/', '', $preco);  // Remove qualquer caractere não numérico (incluindo simbolos de moeda);
        $precoDecimal = substr($precoDecimal, 0, strlen($precoDecimal) - 2) . '.' . substr($precoDecimal, -2);  // Cria um valor com ponto decimal

        // Agora converte para float
        $data['price'] = (float) $precoDecimal;

        $data = Expense::create($data);
        if ($data) {
            session()->flash('success','Gasto adicionado com sucesso');
            return redirect()->route('expense.index');
        } else {
            session()->flash('error','Falha na criação');
            return redirect()->route('expense.create');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $expense = Expense::findOrFail($id);
        //Formatando a data que está em Y/m/d para d/m/Y, pois estou usando um input type text pra data
        $expense['date_of_emission'] = \Carbon\Carbon::createFromFormat('Y-m-d', $expense['date_of_emission'])->format('d/m/Y');

        return view('expense.edit', compact('expense'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExpenseRequest $request, $id)
    {
        $data = $request->validated();
        // Formatando a data que está em Y-m-d para d/m/Y
        $data['date_of_emission'] = \Carbon\Carbon::createFromFormat('d/m/Y', $data['date_of_emission'])->format('Y-m-d');
        //Convert 'price'
        $preco = $data['price'];
        $precoDecimal = preg_replace('/\D/', '', $preco);  // Remove qualquer caractere não numérico (incluindo simbolos de moeda);
        $precoDecimal = substr($precoDecimal, 0, strlen($precoDecimal) - 2) . '.' . substr($precoDecimal, -2);  // Cria um valor com ponto decimal

        // Agora converte para float
        $data['price'] = (float) $precoDecimal;


        $expense = Expense::findOrFail($id);
        
        // $name = $request->name;
        // $diagnostic->name = $name;

        $input = $expense->update($data);
        if ($input) {
            session()->flash('success', 'Gasto atualizado com sucesso!');
            return redirect()->route('expense.index');
        } else {
            session()->flash('error','Falha na edição');
            return redirect()->route('expense.edit');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $input = Expense::destroy($id);
        if ($input) {
            session()->flash('success', 'Gasto excluído com sucesso!');
            return redirect()->route('expense.index');
        } else {
            session()->flash('error', 'Erro na exclusão do Aluno');
            return redirect()->route('expense.index');
        }
    }
}
