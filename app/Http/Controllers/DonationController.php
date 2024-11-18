<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Student;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $donations = Donation::with('student')
            ->join('students', 'donations.student_id', '=', 'students.id')  // Realizando o join com a tabela de partners
            ->select('donations.*','students.name')
            ->orderBy('students.name', 'asc')  // Ordenando pelo nome do parceiro
            ->get();
        return view('donation.home', compact('donations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Donation $donation)
    {
        //
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
        $preco = (float) $request->value;
        $precoFormated = str_replace(',', '.', $preco);
        $precoDecimal = number_format($preco, 2, '.', ',');
        // Atualizar o campo específico
        $donation->{$request->field} = (float) $precoFormated;

        $input = $donation->save();
        if ($input) {
            session()->flash('success', 'Gasto atualizado com sucesso!');
            return redirect()->route('donation.index');
        } else {
            session()->flash('error','Falha na edição');
            return redirect()->route('donation.index');
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
