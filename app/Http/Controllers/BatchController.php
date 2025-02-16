<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Program;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    
    public function index()
    {
        $batches = Batch::latest()->paginate(10);
        return view('batches.index', compact('batches'));
    }

    
    public function create()
    {
        $programs = Program::all();
        return view('batches.create', compact('programs'));
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'program_id' => 'required|exists:programs,id',
            'name' => 'required|string|max:255',
            'limit' => 'required|integer|min:1',
            'estimated_time' => 'required',
            'program_type' => 'required',
        ]);

        $request['program_type'] = json_encode($request['program_type']);

        Batch::create($request->all());

        return redirect()->route('batches.index')->with('success', 'Batch berhasil ditambahkan.');
    }

    
    public function show(Batch $batch)
    {
        return view('batches.show', compact('batch'));
    }

    
    public function edit(Batch $batch)
    {
        $programs = Program::all();
        
        return view('batches.edit', compact('batch', 'programs'));
    }

    
    public function update(Request $request, Batch $batch)
    {
        $request->validate([
            'program_id' => 'required|exists:programs,id',
            'name' => 'required|string|max:255',
            'limit' => 'required|integer|min:1',
        ]);

        $batch->update($request->all());

        return redirect()->route('batches.index')->with('success', 'Batch berhasil diperbarui.');
    }

    
    public function destroy(Batch $batch)
    {
        $batch->delete();

        return redirect()->route('batches.index')->with('success', 'Batch berhasil dihapus.');
    }
}
