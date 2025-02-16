<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Program;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class UserDetailController extends Controller
{
    public function index(Request $request)
    {
        $query = UserDetail::with('program');

        // Filter by program
        if ($request->filled('program_id')) {
            $query->where('program_id', $request->program_id);
        }

        $programs = Program::all();
        $userDetails = $query->paginate(10)->appends($request->all());

        return view('user_details.index', compact('userDetails', 'programs'));
    }

    public function create()
    {
        $programs = Program::all();
        return view('user_details.create', compact('programs'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'program_id' => 'required|exists:programs,id',
            'instance' => 'required|string|max:255',
            'email' => 'required|email',
            'address' => 'required|string',
            'identity_type' => 'required|in:KTP,SIM,KP',
            'identity_number' => 'required|string|max:50',
            'reason_to_join' => 'required|string',
            'phone_number' => 'required|string|max:15',
            'information_source' => 'nullable|string|max:255',
            'referral' => 'nullable|string|max:255',
            'occupation' => 'required|string|max:255',
            'batch_id' => 'required|exists:batches,id',
        ]);

        // Ambil batch yang dipilih
        $batch = Batch::findOrFail($data['batch_id']);

        // Cek apakah jumlah peserta dalam batch sudah mencapai batas limit
        $currentParticipants = $batch->users()->count();
        if ($currentParticipants >= $batch->limit) {
            return redirect()->back()->with('error', 'Kuota batch ini sudah penuh.');
        }

        // Cek apakah user sudah terdaftar dalam program ini
        $existingUser = UserDetail::where('name', $data['name'])
            ->where('identity_number', $data['identity_number'])
            ->where('program_id', $data['program_id'])
            ->exists();

        if ($existingUser) {
            return redirect()->back()->with('error', 'Peserta sudah terdaftar dalam kelas ini.');
        }

        // Tambahkan peserta baru jika masih ada slot
        UserDetail::create($data);

        return redirect()->back()->with('success', 'User berhasil ditambahkan.');
    }



    public function edit($id)
    {
        $userDetail = UserDetail::findOrFail($id);
        $programs = Program::all();

        return view('user_details.edit', compact('userDetail', 'programs'));
    }

    public function update(Request $request, $id)
    {
        $userDetail = UserDetail::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'program_id' => 'required|exists:programs,id',
            'instance' => 'required|string|max:255',
            'email' => "required|email",
            'address' => 'required|string',
            'identity_type' => 'nullable|in:KTP,SIM,KP',
            'identity_number' => 'nullable|string|max:50',
            'reason_to_join' => 'nullable|string',
            'phone_number' => "required|string|max:15",
            'information_source' => 'nullable|string|max:255',
            'referral' => 'nullable|string|max:255',
            'occupation' => 'nullable|string|max:255',
        ]);

        $userDetail->update($data);

        return redirect()->route('user_details.index')->with('success', 'User detail berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $userDetail = UserDetail::findOrFail($id);
        $userDetail->delete();

        return redirect()->route('user_details.index')->with('success', 'User detail berhasil dihapus.');
    }

    public function exportPdf($id)
    {
        $userDetail = UserDetail::with('program')->findOrFail($id);

        $pdf = Pdf::loadView('user_details.certificate', compact('userDetail'))->setPaper('a4', 'landscape');

        return $pdf->download("certificate_{$userDetail->name}_{$userDetail->program_id}.pdf");
    }

    public function exportExcel()
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\UserDetailsExport, 'user_details.xlsx');
    }
}
