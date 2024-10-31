<?php

namespace App\Http\Controllers;

use App\Models\Student;
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
        $students = Student::with('diagnostic')->orderBy('id', 'asc')->get();
        $total = Student::count();
        return view('student.home', compact(['students', 'total']));
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
        }
        ;

        $input = Student::create($data);
        if ($input) {
            session()->flash('success', 'Aluno adicionado com sucesso');
            return redirect()->route('student.index');
        } else {
            session()->flash('error', 'Falha na criação do Aluno');
            return redirect()->route('student.create');
        }

    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        //Formatando a data que está em Y/m/d para d/m/Y, pois estou usando um input type text pra data
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

        if ($input) {
            session()->flash('success', 'Aluno atualizado com sucesso!');
            return redirect()->route('student.index');
        } else {
            session()->flash('error', 'Falha na edição do Aluno');
            return redirect()->route('student.edit');
        }

    }

    public function destroy($id)
    {
        $data = Student::find($id);
        if ($data->image) {
            $destination = public_path('img/student/' . $data->image);

            if (file_exists($destination) && $destination != public_path('img/student/Foto_Desconhecido.jpg')) {
                unlink($destination);
            };
        };

        $input = Student::destroy($id);

        if ($input) {
            session()->flash('success', 'Aluno excluído com sucesso!');
            return redirect()->route('student.index');
        } else {
            session()->flash('error', 'Erro na exclusão do Aluno');
            return redirect()->route('student.index');
        }


    }
}
