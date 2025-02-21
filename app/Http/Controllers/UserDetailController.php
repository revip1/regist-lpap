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
        $query = UserDetail::query()->with(['program', 'batch', 'user']);

        if ($request->filled('search_name')) {
            $query->where('name', 'like', '%' . $request->search_name . '%');
        }


        if ($request->filled('program_id')) {
            $query->where('program_id', $request->program_id);
        }


        if ($request->filled('user_role')) {
            if ($request->user_role == 'company') {
                $query->whereHas('user', function ($q) {
                    $q->where('role', 'company');
                });
            } elseif ($request->user_role == 'user') {

                $query->where(function ($q) {
                    $q->whereDoesntHave('user') // Jika tidak ada user terkait
                    ->orWhereHas('user', function ($subQuery) {
                        $subQuery->where('role', '!=', 'company'); // Jika user bukan company
                    });
                });
            }
        }

        $userDetails = $query->paginate(10);
        $programs = Program::all();

        return view('user_details.index', compact('userDetails', 'programs'));
    }



    


    public function create()
    {
        $programs = Program::all();
        $batch = Batch::all();
        // return view('user_details.create', compact('programs'));
        return view('user_details.create', [
          'programs' => $programs,
          'batch' => $batch
        ]);
    }

    public function store(Request $request)
    {
        if (isset($request->user_type) && $request->user_type == "company"):
          $data = array();
          $req = $request->all();
          for ($i = 0; $i < $request->number_of_participants; $i++):
            $data['email'] = $req['email'];
            $data['instance'] = $req['instance'];
            $data['program_id'] = $req['program_id'];
            $data['batch_id'] = $req['batch_id'];
            $data['place'] = $req['place'];
            $data['number_of_participants'] = $req['number_of_participants'];
            $data['name'] = $req['nama-'.($i+1)];
            $data['position'] = $req['jabatan-'.($i+1)];
            $data['phone_number'] = $req['no_handphone-'.($i+1)];
            $data['reason_to_join'] = $req['reason_to_join'];
            $data['information_source'] = $req['information_source'];
            $data['referral'] = isset($req['referral'])? $req['referral'] : "";

            UserDetail::create($data);
          endfor;
        else:
          $data = $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required',
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
            'place' => 'required',
            'last_education' => 'required|string',
          ]);

           
          $batch = Batch::findOrFail($data['batch_id']);

          
          $currentParticipants = $batch->users()->count();
          if ($currentParticipants >= $batch->limit) {
              return redirect()->back()->with('error', 'Kuota batch ini sudah penuh.');
          }

          $existingUser = UserDetail::where('name', $data['name'])
            ->where('identity_number', $data['identity_number'])
            ->where('program_id', $data['program_id'])
            ->exists();

          if ($existingUser) {
              return redirect()->back()->with('error', 'Peserta sudah terdaftar dalam kelas ini.');
          }

          UserDetail::create($data);
        endif;

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
