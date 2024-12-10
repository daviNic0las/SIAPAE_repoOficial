<?php

namespace App\Http\Controllers;

use App\Models\Frequency;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FrequencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $class_apae_input = request('class_apae');
        $turn_apae_input = request('turn_apae');
        $monthYear = request('monthYear');

        if($class_apae_input && $turn_apae_input && $monthYear) {

            $frequencies = Frequency::where('class_apae', $class_apae_input)->
                where('turn_apae', $turn_apae_input)->
                where('month_year', $monthYear)-> 
                orderBy('student_name', 'asc')->
                paginate(15);

        } else {
            $monthYear = Carbon::now()->format('m/Y');

            $frequencies = Frequency::orderBy('student_name','asc')->paginate(15);
        }

        // Para contar a quantidade de dias do mês pesquisado ou atual (caso não haja valor no input) 
        list($month, $year) = explode('/', $monthYear); 
        $month = (int) $month; 
        $year = (int) $year;
        $numberDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        // Cria uma lista de dias para o mês
        $days = range(1, $numberDaysInMonth);

        return view('frequency.home', compact('frequencies', 'class_apae_input', 'turn_apae_input', 'monthYear', 'days', 'numberDaysInMonth'));
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
    public function show(Frequency $frequency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Frequency $frequency)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Frequency $frequency)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Frequency $frequency)
    {
        //
    }
}
