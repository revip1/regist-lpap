<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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

            $data = $request->validate([
                'name' => 'required|string|max:255',
                'label' => 'required|string|max:255',
                'description' => 'required|string',
                'referral_required' => 'required',
            ]);
    

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
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'label' => 'required|string|max:255',
            'description' => 'required|string',
            'referral_required' => 'required',
            'status' => 'required|in:active,inactive',
        ]);


        $program = Program::find($id);

        if (!$program) {
            return redirect()->route('programs.index')->with('error', 'Program tidak ditemukan.');
        }

        $program->update($data);

        return redirect()->route('programs.index')->with('success', 'Program berhasil diperbarui.');
    }


    public function destroy(Request $request, $id)
    {
        $request->validate([
            'password' => 'required',
        ]);

        if (!Hash::check($request->password, Auth::user()->password)) {
            return redirect()->route('programs.index')->with('error', 'Password salah. Program tidak dihapus.');
        }

        $program = Program::find($id);
        if ($program) {
            $program->update(['status' => 'inactive']);
            return redirect()->route('programs.index')->with('success', 'Program telah dinonaktifkan.');
        } else {
            return redirect()->route('programs.index')->with('error', 'Program tidak ditemukan.');
        }
    }

}
