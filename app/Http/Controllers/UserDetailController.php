<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class UserDetailController extends Controller
{
    public function index()
    {
        $userDetails = UserDetail::with('ticket')->paginate(10);
        return view('user_details.index', compact('userDetails'));
    }

    public function create()
    {
        $tikets = Ticket::all();
        return view('user_details.create', compact('tikets'));
    }

    public function certificate($id)
    {
        $userDetail = UserDetail::with('ticket')->find($id);

        if (!$userDetail) {
            return redirect()->route('user_details.index')->with('error', 'Data User Detail tidak ditemukan');
        }

        return view('user_details.certificate', compact('userDetail'));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'whatsapp_number' => 'required|string|max:15',
            'email' => 'required|email|unique:user_details',
            'address' => 'required|string|max:255',
            'occupation' => 'required|string|max:255',
            'instance' => 'required|string|max:255',
            'reason' => 'required|string|max:255',
            'source_of_info' => 'required|string|max:255',
            'referral' => 'nullable|string|max:255',
            'ticket_id' => 'required|exists:tickets,id',
        ]);

        // Cek apakah tiket sudah digunakan
        $ticket = Ticket::find($data['ticket_id']);
        $isTicketUsed = UserDetail::where('ticket_id', $ticket->id)->exists();

        if ($isTicketUsed) {
            return redirect()->back()->withErrors(['ticket_id' => 'Kode tiket sudah digunakan, pilih tiket lain.']);
        }

        UserDetail::create($data);

        return redirect()->route('user_details.index')->with('success', 'Data User Detail berhasil ditambahkan');
    }

    public function edit($id)
    {
        $userDetail = UserDetail::find($id);

        if (!$userDetail) {
            return redirect()->route('user_details.index')->with('error', 'Data User Detail tidak ditemukan');
        }

        return view('user_details.edit', compact('userDetail'));
    }

    public function update(Request $request, $id)
    {
        $userDetail = UserDetail::find($id);

        if (!$userDetail) {
            return redirect()->route('user_details.index')->with('error', 'Data User Detail tidak ditemukan');
        }

        $data = $request->validate([
            'full_name' => 'sometimes|string|max:255',
            'whatsapp_number' => 'sometimes|string|max:15',
            'email' => 'sometimes|email|unique:user_details,email,' . $id,
            'address' => 'sometimes|string|max:255',
            'occupation' => 'sometimes|string|max:255',
            'instance' => 'sometimes|string|max:255',
            'reason' => 'sometimes|string|max:255',
            'source_of_info' => 'sometimes|string|max:255',
            'referral' => 'nullable|string|max:255',
            'ticket_id' => 'sometimes|exists:tickets,id',
        ]);

        // Jika ticket_id diubah, validasi apakah tiket sudah digunakan
        if (isset($data['ticket_id']) && $data['ticket_id'] != $userDetail->ticket_id) {
            $ticket = Ticket::find($data['ticket_id']);
            $isTicketUsed = UserDetail::where('ticket_id', $ticket->id)->exists();

            if ($isTicketUsed) {
                return redirect()->back()->withErrors(['ticket_id' => 'Kode tiket sudah digunakan, pilih tiket lain.']);
            }
        }

        $userDetail->update($data);

        return redirect()->route('user_details.index')->with('success', 'Data User Detail berhasil diubah');
    }


    public function destroy($id)
    {
        $userDetail = UserDetail::find($id);

        if (!$userDetail) {
            return redirect()->route('user_details.index')->with('error', 'Data User Detail tidak ditemukan');
        }

        $userDetail->delete();

        return redirect()->route('user_details.index')->with('success', 'Data User Detail berhasil dihapus');
    }

    public function exportPdf($id)
    {
        $userDetail = UserDetail::with('ticket.program')->find($id);

        if (!$userDetail) {
            abort(404, 'User not found');
        }

        // Render Blade view to HTML
        $html = view('user_details.certificate', compact('userDetail'))->render();

        // Generate PDF with Dompdf
        $pdf = Pdf::loadHTML($html)->setPaper('a4', 'landscape');

        // Return PDF as download
        return $pdf->download("certificate_{$userDetail->full_name}_{$userDetail->ticket->program->name}.pdf");
    }
    
    public function exportExcel()
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\UserDetailsExport, 'user_details.xlsx');
    }
    
}
