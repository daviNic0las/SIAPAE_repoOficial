<?php

namespace App\Http\Controllers;

use App\Http\Requests\MedHistoryRequest;
use App\Models\MedHistory;
use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class MedHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request('search');

        if ($search) {
            $medHistories = MedHistory::where([
                ['student->name', 'like', '%' . $search . '%']
            ])->with('student.diagnostic')
            ->orderBy('student->name', 'asc')
            ->paginate(10);
        } else {
            $medHistories = MedHistory::with('student.diagnostic')
            ->orderBy('student->name', 'asc')
            ->paginate(10);
        }

        return view('med_history.home', compact('medHistories', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::with('diagnostic')->get();

        return view ('med_history.create', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MedHistoryRequest $request)
    {
        $data = $request->validated();
        // Convert string to data
        $data['date_of_anamnesis'] = \Carbon\Carbon::createFromFormat('d/m/Y', $data['date_of_anamnesis'])->format('Y-m-d');
        $data['date_mother'] = \Carbon\Carbon::createFromFormat('d/m/Y', $data['date_mother'])->format('Y-m-d');
        $data['date_father'] = \Carbon\Carbon::createFromFormat('d/m/Y', $data['date_father'])->format('Y-m-d');

        $input = MedHistory::create($data);
        if ($input) {
            session()->flash('success', 'Anamnese adicionada com sucesso');
            return redirect()->route('med_history.index');
        } else {
            session()->flash('error', 'Falha na criação da Anamnese');
            return redirect()->route('med_history.create');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(MedHistory $medHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MedHistory $medHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MedHistoryRequest $request, MedHistory $medHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MedHistory $medHistory)
    {
        //
    }
}
