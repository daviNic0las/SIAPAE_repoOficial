<?php
 
namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
use App\Models\Student;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AttendanceRequest;


class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $date_range = request('date_range'); 

        if ($date_range) { 
            $dates = explode(' até ', $date_range); 
            $start_date = \Carbon\Carbon::createFromFormat('d/m/Y', trim($dates[0]))->format('Y-m-d'); 
            $end_date = \Carbon\Carbon::createFromFormat('d/m/Y', trim($dates[1]))->format('Y-m-d'); 
            $attendances = Attendance::whereDate('date', '>=', $start_date)
                ->whereDate('date', '<=', $end_date) ->orderBy('date', 'asc') 
                ->paginate(15); 
        } else { 
            $attendances = Attendance::orderBy('date', 'asc')
                ->paginate(15);
        }
        
        return view('attendance.home', compact('attendances', 'date_range'));
    }
    


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::orderBy('name', 'asc')->get();
        $users = User::orderBy('name', 'asc')->get();
        return view('attendance.create', compact('users', 'students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AttendanceRequest $request)
    {
        $data = $request->validated();
        // Convert 'string' to data
        $data['date'] = \Carbon\Carbon::createFromFormat('d/m/Y', $data['date'])->format('Y-m-d');
        //Para a data criada seja aquela que vai aparecer no .index
        $carbonDate = \Carbon\Carbon::parse($data['date']);
        $year = $carbonDate->year;  
        
        $data = Attendance::create($data);
        if ($data) {
            session()->flash('success','Registro adicionado com sucesso');
            return redirect()->route('attendance.index', compact('year'));
        } else {
            session()->flash('error','Falha na criação');
            return redirect()->route('attendance.create');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance['date'] = \Carbon\Carbon::createFromFormat('Y-m-d', $attendance['date'])->format('d/m/Y');


        $students = Student::orderBy('name', 'asc')->get();
        $users = User::orderBy('name', 'asc')->get();

        return view('attendance.show', compact('attendance', 'students', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $attendance = Attendance::findOrFail($id);
        // Formatando a data que está em Y/m/d para d/m/Y, pois estou usando um input type text pra data
        $attendance['date'] = \Carbon\Carbon::createFromFormat('Y-m-d', $attendance['date'])->format('d/m/Y');

        $students = Student::orderBy('name', 'asc')->get();
        $users = User::orderBy('name', 'asc')->get();

        return view('attendance.edit', compact('attendance', 'students', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AttendanceRequest $request, $id)
    {
        $data = $request->validated();
        // Formatando a data que está em Y-m-d para d/m/Y
        $data['date'] = \Carbon\Carbon::createFromFormat('d/m/Y', $data['date'])->format('Y-m-d');
        //Para a data criada seja aquela que vai aparecer no .index
        $carbonDate = \Carbon\Carbon::parse($data['date']);
        $year = $carbonDate->year; 
        
        $attendance = Attendance::findOrFail($id);
        
        $input = $attendance->update($data);
        if ($input) {
            session()->flash('success', 'Registro atualizado com sucesso!');
            return redirect()->route('attendance.index', compact('year'));
        } else {
            session()->flash('error','Falha na edição');
            return redirect()->route('attendance.edit');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         $data = Attendance::findOrFail($id);
        // Para a data criada seja aquela que vai aparecer no .index
        $carbonDate = \Carbon\Carbon::parse($data['date']);
        $year = $carbonDate->year; 

        $input = Attendance::destroy($id);
        if ($input) {
            session()->flash('success', 'Registro excluído com sucesso!');
            return redirect()->route('attendance.index', compact('year'));
        } else {
            session()->flash('error', 'Erro na exclusão do Aluno');
            return redirect()->route('attendance.index');
        }
    }
}
