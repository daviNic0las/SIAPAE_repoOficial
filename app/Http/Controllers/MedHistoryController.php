<?php

namespace App\Http\Controllers;

use App\Models\MedHistory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MedHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        return view('errors.404');
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
    public function update(Request $request, MedHistory $medHistory)
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
