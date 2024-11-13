<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Http\Controllers\Controller;
use App\Http\Requests\RecordRequest;

class RecordController extends Controller
{
    public function index()
    {
        $records = Record::orderBy('id', 'asc')->get();
        return view('record.home', compact(['records']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('record.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RecordRequest $request)
    {
        $data = $request->validated();
        // dd($data);
        $data['date'] = \Carbon\Carbon::createFromFormat('d/m/Y', $data['date'])->format('Y-m-d');

        if ($request->hasfile('file') && $request->file('file')->isValid()) {

            $file = $request->file('file');
            $fileName = $request->file->getClientOriginalName();

            $file->move(public_path('file/record/'), $fileName);
            $data['file'] = $fileName;

        }
        ;

        $input = Record::create($data);
        if ($input) {
            session()->flash('success', 'Ata adicionada com sucesso');
            return redirect()->route('record.index');
        } else {
            session()->flash('error', 'Falha na criação');
            return redirect()->route('record.create');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $record = Record::findOrFail($id);
        $record['date'] = \Carbon\Carbon::createFromFormat('Y-m-d', $record['date'])->format('d/m/Y');
        return view('record.edit', compact('record'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RecordRequest $request, $id)
    {
        $data = $request->validated();

        $record = Record::findOrFail($id);
        $data['date'] = \Carbon\Carbon::createFromFormat('d/m/Y', $data['date'])->format('Y-m-d');

        if ($request->has('file')) {
            //Check old image
            $destination = "file/record/" . $record->file;

            //Remove old images
            \File::delete(public_path($destination));

            $file = $request->file('file');
            $fileName = $request->file->getClientOriginalName();

            $file->move(public_path('file/record/'), $fileName);
            $data['file'] = $fileName;

        } else {
            $data['file'] = $record['file'];
        }

        $input = $record->update($data);
        if ($input) {
            session()->flash('success', 'Ata atualizada com sucesso!');
            return redirect()->route('record.index');
        } else {
            session()->flash('error', 'Falha na edição');
            return redirect()->route('record.edit');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Record::find($id);
        if ($data->file) {
            $destination = public_path('file/record/' . $data->file);
            unlink($destination);
        }
        ;


        $input = Record::findOrFail($id)->delete();
        if ($input) {
            session()->flash('success', 'Categoria excluída com sucesso!');
            return redirect()->route('record.index');
        } else {
            session()->flash('error', 'Erro na exclusão do item');
            return redirect()->route('record.index');
        }
    }
}