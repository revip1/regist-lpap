<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::latest()->paginate(10);
        return view('programs.index', compact('programs'));
    }

    public function show($id){
        $program = Program::find($id);
        if($program){
            return response()->json(['message' => 'Data Program berhasil diambil', 'data' => $program]);
        } else {
            return response()->json(['message' => 'Data Program tidak ditemukan'], 404);
        }
    }

    public function create(){
        return view('programs.create');
    }

    public function store(Request $request){
        try {
            // Validasi data
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'label' => 'required|string|max:255',
                'description' => 'required|string',
                'place' => 'required|string',
            ]);
    
            // Simpan data ke database
            Program::create($data);
    
            return redirect()->back()->with('success','Program berhasil ditambahkan.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }

    public function edit($id)
    {
        $program = Program::find($id);

        if (!$program) {
            return redirect()->route('programs.index')->with('error', 'Program tidak ditemukan.');
        }

        return view('programs.edit', compact('program'));
    }


    public function update(Request $request, $id)
    {
        // Validasi data
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'label' => 'required|string|max:255',
            'description' => 'required|string',
            'place' => 'required|string',
        ]);

        // Cari program berdasarkan ID
        $program = Program::find($id);

        if (!$program) {
            // Jika program tidak ditemukan, redirect dengan pesan error
            return redirect()->route('programs.index')->with('error', 'Program tidak ditemukan.');
        }

        // Update data program
        $program->update($data);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('programs.index')->with('success', 'Program berhasil diperbarui.');
    }


    public function destroy($id){
        $program = Program::find($id);
        if($program){
            $program->delete();
            return redirect()->route('programs.index')->with('success', 'Program telah dihapus.');
        } else {
            return redirect()->route('programs.index')->with('error', 'Program tidak ditemukan.');
        }
    }
}
