<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index()
    {
        $program = Program::latest()->paginate(10);
        return response()->json(['message' => 'Data Program berhasil diambil', 'data' => $program]);
    }

    public function show($id){
        $program = Program::find($id);
        if($program){
            return response()->json(['message' => 'Data Program berhasil diambil', 'data' => $program]);
        } else {
            return response()->json(['message' => 'Data Program tidak ditemukan'], 404);
        }
    }

    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'label' => 'required|string|max:255',
            'description' => 'required|string',
            'code' => 'required|string|max:10|unique:programs',
        ]);

        $program = Program::create($data);
        return response()->json(['message' => 'Data Program berhasil ditambahkan', 'data' => $program], 201);
    }

    public function update(Request $request, $id){
        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'code' => 'sometimes|string|max:10|unique:programs,code,' . $id,
        ]);

        $program = Program::find($id);
        if($program){
            $program->update($data);
            return response()->json(['message' => 'Data Program berhasil diubah', 'data' => $program]);
        } else {
            return response()->json(['message' => 'Data Program tidak ditemukan'], 404);
        }
    }

    public function destroy($id){
        $program = Program::find($id);
        if($program){
            $program->delete();
            return response()->json(['message' => 'Data Program berhasil dihapus']);
        } else {
            return response()->json(['message' => 'Data Program tidak ditemukan'], 404);
        }
    }
}
