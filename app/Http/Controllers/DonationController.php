<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DonationController extends Controller
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
            $donations = Donation::where('year_of_donation', $year)
            ->with('student')
            ->join('students', 'donations.student_id', '=', 'students.id')  // Realizando o join com a tabela de partners
            ->select('donations.*','students.name')
            ->orderBy('students.name', 'asc')  // Ordenando pelo nome do parceiro
            ->paginate(10);
        } else {
            // Caso contrário, pega todos os gastos com o ano atual
            $year = \Carbon\Carbon::now()->year;
            $donations = Donation::where('year_of_donation', $year)
            ->with('student')
            ->join('students', 'donations.student_id', '=', 'students.id')  // Realizando o join com a tabela de partners
            ->select('donations.*','students.name')
            ->orderBy('students.name', 'asc')  // Ordenando pelo nome do parceiro
            ->paginate(10);
        }

        // Obtém os anos disponíveis para o select
        $years = Donation::selectRaw('year_of_donation as year')
            ->distinct()
            ->orderByDesc('year')->pluck('year', 'year');

        return view('donationD.home', compact('donations', 'years', 'year'));
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
    public function show(Request $request, $id)
    {
        return view('errors.404');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Donation $donation)
    {
        return view('errors.404');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // $validated = $request->validate([
        //     'preco' => 'nullable|numeric|max:6',
        //     'field' => 'required|string|max:6',
        // ]);

        $donation = Donation::findOrFail($id);

        if (!$donation) {
            return response()->json(['message' => 'Doação não encontrada.'], 404);
        }

        //Convert 'price'
        $preco = $request->value;
        // Atualizar o campo específico
        $donation->{$request->field} = (float) $preco;

        $input = $donation->update();
        if ($input) {
            session()->flash('success', 'Gasto atualizado com sucesso!');
            return redirect()->route('donationD.index');
        } else {
            session()->flash('error','Falha na edição');
            return redirect()->route('donationD.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Donation $donation)
    {
        //
    }
}
