<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentApiController extends Controller
{
    public function getStudentData($id)
    {
        // Busca os dados do aluno
        $student = Student::find($id);
        //Retorna os dados do aluno em formato JSON
        if ($student) {
            return response()->json([
                'date_of_birth' => \Carbon\Carbon::createFromFormat('Y-m-d', $student->date_of_birth)->format('d/m/Y'),
                'diagnostic' => $student->diagnostic,
                'school' => $student->school,
                'grade_school' => $student->grade_school,
                'class_school' => $student->class_school,
                'turn_school' => $student->turn_school,
            ]);
        } else {
            return response()->json(['error' => 'Estudante não encontrado'], 404);
        }

    }
    
    public function deposit() 
    {
        $search = request('search');
        
        if ($search) {
            $students = Student::where([
                ['name', 'like', '%' . $search . '%']
            ])->where('state_student', 'archived')
            ->orderBy('name', 'asc')
            ->paginate(15);
        } else {
            $students = Student::where('state_student', 'archived')
            ->orderBy('name', 'asc')
            ->paginate(15);
        }

        return view('student.deposit', compact('students', 'search'));
    }
    public function archive($id)
    {
        $student = Student::find($id);

        $student['state_student'] = 'archived';

        $input = $student->save();

        if ($input) {
            session()->flash('success', 'Aluno arquivado com sucesso!');
            return redirect()->route('student.index');
        } else {
            session()->flash('error', 'Erro na arquivação do Aluno');
            return redirect()->route('student.index');
        }
    }
    public function restore($id) 
    {
        $student = Student::find($id);

        $student['state_student'] = 'alive';

        $input = $student->save();

        if ($input) {
            session()->flash('success', 'Aluno Restaurado com sucesso!');
            return redirect()->route('student.deposit');
        } else {
            session()->flash('error', 'Erro na restauração do Aluno');
            return redirect()->route('student.deposit');
        }
    }
}
