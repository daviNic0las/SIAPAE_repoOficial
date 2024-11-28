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
        $student = Student::with('diagnostic')->find($id);
        //Retorna os dados do aluno em formato JSON
        if ($student) {
            return response()->json([
                'date_of_birth' => \Carbon\Carbon::createFromFormat('Y-m-d', $student->date_of_birth)->format('d/m/Y'),
                'diagnostic' => $student->diagnostic->name,
                'school' => $student->school,
                'grade_school' => $student->grade_school,
                'class_school' => $student->class_school,
                'turn_school' => $student->turn_school,
            ]);
        } else {
            return response()->json(['error' => 'Estudante não encontrado'], 404);
        }

    }
    public function teste()
    {
        return view('teste');
    }
}
