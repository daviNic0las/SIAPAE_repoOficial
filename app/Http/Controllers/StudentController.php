<?php

namespace App\Http\Controllers;

use App\Models\MedHistory;
use App\Models\Student;
use App\Models\Attendance;
use App\Events\StudentUpdated;
use App\Models\Diagnostic;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request('search');
        
        if ($search) {
            $students = Student::where([
                ['name', 'like', '%' . $search . '%']
            ])->where('state_student', 'alive')
            ->with('diagnostic')
            ->orderBy('name', 'asc')
            ->paginate(15);
        } else {
            $students = Student::with('diagnostic')
            ->where('state_student', 'alive')
            ->orderBy('name', 'asc')
            ->paginate(15);
        }

        return view('student.home', compact('students', 'search'));
    }

    public function create()
    {
        $diagnostics = Diagnostic::all();
        return view('student.create', compact('diagnostics'));
    }

    public function store(StudentRequest $request)
    {
        $data = $request->validated();
        // Convert string to data
        $data['date_of_birth'] = \Carbon\Carbon::createFromFormat('d/m/Y', $data['date_of_birth'])->format('Y-m-d');

        if ($request->hasfile('image') && $request->file('image')->isValid()) {

            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('img/student/'), $imageName);
            $data['image'] = $imageName;

        } else {
            $data['image'] = "Foto_Desconhecido.jpg";
        };

        $input = Student::create($data);
        if ($input) {
            session()->flash('success', 'Aluno adicionado com sucesso');
            return redirect()->route('student.index');
        } else {
            session()->flash('error', 'Falha na criação do Aluno');
            return redirect()->route('student.create');
        }

    }
    public function show($id)
    {
        $student = Student::with('diagnostic')->findOrFail($id);
        
        $medHistory = null;
         
        $medHistoryExists = MedHistory::where('student_id', $id)->exists();
        if($medHistoryExists) {
            $medHistory = MedHistory::where('student_id', $id)->first();
        }

        $isTrash = null;
        if($student['state_student'] == 'trash') {
            $isTrash = true; 
        }

        $date_range = request('date_range'); 
        $scrollBack = null;

        if ($date_range) { 
            $dates = explode(' até ', $date_range); 
            $start_date = \Carbon\Carbon::createFromFormat('d/m/Y', trim($dates[0]))->format('Y-m-d'); 
            $end_date = \Carbon\Carbon::createFromFormat('d/m/Y', trim($dates[1]))->format('Y-m-d'); 
            
            $attendances = Attendance::whereDate('date', '>=', $start_date)
                ->whereDate('date', '<=', $end_date) 
                ->where('student_id', $id)
                ->with('student')
                ->orderBy('date', 'desc') 
                ->paginate(15); 

            $scrollBack = true;
        } else { 
            $attendances = Attendance::where('student_id', $id)
            ->with('student')
            ->orderBy('date', 'desc') 
            ->paginate(15); 
        }

        return view('student.show', compact('student', 'medHistory', 'attendances', 'date_range', 'scrollBack', 'isTrash'));
    }
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        
        //Convert data to string
        $student['date_of_birth'] = \Carbon\Carbon::createFromFormat('Y-m-d', $student['date_of_birth'])->format('d/m/Y');

        $diagnostics = Diagnostic::orderBy('name', 'asc')->get();
        return view('student.edit', compact('student', 'diagnostics'));
    }

    public function update(StudentRequest $request, $id)
    {
        $student = Student::findOrFail($id);
        $data = $request->validated();

        // Convert string to data
        $data['date_of_birth'] = \Carbon\Carbon::createFromFormat('d/m/Y', $data['date_of_birth'])->format('Y-m-d');

        if ($request->has('image')) {
            //Check old image
            $destination = "img/student/" . $student->image;

            //Remove old images
            if (\File::exists(public_path($destination)) && $student->image !== "Foto_Desconhecido.jpg") {
                \File::delete(public_path($destination));
            }

            //Add new image
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            //Update new image
            $request->image->move(public_path('img/student/'), $imageName);
            $data['image'] = $imageName;

        };

        $input = $student->update($data);
        // Dispara o evento p/ att a lista de frequência tbm
        // event(new StudentUpdated($student, $oldName));

        if ($input) {
            session()->flash('success', 'Aluno atualizado com sucesso!');
            return redirect()->route('student.index');
        } else {
            session()->flash('error', 'Falha na edição do Aluno');
            return redirect()->route('student.edit');
        }

    }
}

// Destroy para as imagens
// if ($data->image) {
//     $destination = public_path('img/student/' . $data->image);

//     if (file_exists($destination) && $destination != public_path('img/student/Foto_Desconhecido.jpg')) {
//         unlink($destination);
//     };
// };