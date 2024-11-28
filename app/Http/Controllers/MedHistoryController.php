<?php

namespace App\Http\Controllers;

use App\Http\Requests\MedHistoryRequest;
use App\Models\MedHistory;
use App\Http\Controllers\Controller;
use App\Models\Student;
use lluminate\Support\Facades\Log;
use Illuminate\Http\Request;

class MedHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = request('search');
        
        if ($search) {
            $medHistories = MedHistory::with('student.diagnostic')
            ->whereHas('student', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })->select('med_histories.*')
            ->join('students', 'students.id', '=', 'med_histories.student_id')  
            ->orderBy('students.name', 'asc')
            ->paginate(15);
        } else {
            $medHistories = MedHistory::select('med_histories.*')
                ->join('students', 'students.id', '=', 'med_histories.student_id')
                ->with('student.diagnostic')
                ->orderBy('students.name', 'asc')
                ->paginate(15);
        }

        return view('med_history.home', compact('medHistories', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::with('diagnostic')->get();

        return view('med_history.create', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MedHistoryRequest $request)
    {
        // Handle values of checkbox   
        $data['have_caregiver'] = (bool)$request['have_caregiver'];
        $data['have_AEE'] = (bool)$request['have_AEE'];
        $data['have_medication'] = (bool)$request['have_medication'];
        $data['have_kinship_parents'] = (bool)$request['have_kinship_parents'];
        $data['new_relation_mother'] = (bool)$request['new_relation_mother'];
        $data['new_relation_father'] = (bool)$request['new_relation_father'];

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
        return view('errors.404');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $medHistory = MedHistory::with('student.diagnostic')
        ->findOrFail($id);

        $medHistory['date_of_anamnesis'] = \Carbon\Carbon::createFromFormat('Y-m-d', $medHistory['date_of_anamnesis'])->format('d/m/Y');
        $medHistory['date_mother'] = \Carbon\Carbon::createFromFormat('Y-m-d', $medHistory['date_mother'])->format('d/m/Y');
        $medHistory['date_father'] = \Carbon\Carbon::createFromFormat('Y-m-d', $medHistory['date_father'])->format('d/m/Y');

        $students = Student::orderBy('name', 'asc')->get();

        return view('med_history.edit', compact('medHistory', 'students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MedHistoryRequest $request, $id)
    {
        $medHistory = MedHistory::findOrFail($id);
        // Handle values of checkbox   
        $data['have_caregiver'] = (bool)$request['have_caregiver'];
        $data['have_AEE'] = (bool)$request['have_AEE'];
        $data['have_medication'] = (bool)$request['have_medication'];
        $data['have_kinship_parents'] = (bool)$request['have_kinship_parents'];
        $data['new_relation_mother'] = (bool)$request['new_relation_mother'];
        $data['new_relation_father'] = (bool)$request['new_relation_father'];

        $data = $request->validated();

        // Convert string to data
        $data['date_of_anamnesis'] = \Carbon\Carbon::createFromFormat('d/m/Y', $data['date_of_anamnesis'])->format('Y-m-d');
        $data['date_mother'] = \Carbon\Carbon::createFromFormat('d/m/Y', $data['date_mother'])->format('Y-m-d');
        $data['date_father'] = \Carbon\Carbon::createFromFormat('d/m/Y', $data['date_father'])->format('Y-m-d');

        $input = $medHistory->update($data);
        if ($input) {
            session()->flash('success', 'Anamnese atualizada com sucesso');
            return redirect()->route('anamnesis.index');

        } else {
            session()->flash('error', 'Falha na atualização da Anamnese');
            return redirect()->route('anamnesis.create');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MedHistory $medHistory)
    {
        //
    }
}
