<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Program;
use App\Models\Ticket;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class UserDetailController extends Controller
{
    public function index(Request $request)
    {
        $query = UserDetail::with(['ticket.program', 'ticket.batch', 'user']);

        // Filter by program
        if ($request->filled('program_id')) {
            $query->whereHas('ticket', function($q) use ($request) {
                $q->where('program_id', $request->program_id);
            });
        }

        // Filter by batch
        if ($request->filled('batch_id')) {
            $query->whereHas('ticket', function($q) use ($request) {
                $q->where('batch_id', $request->batch_id);
            });
        }

        // Get programs and batches for filter dropdowns
        $programs = Program::all();
        $batches = Batch::all();
        
        $userDetails = $query->paginate(10)
            ->appends($request->all());

        return view('user_details.index', compact('userDetails', 'programs', 'batches'));
    }

    public function create()
    {
        $tickets = Ticket::all();
        $users = User::all();
        $loggedUser = auth()->user();

        return view('user_details.create', compact('tickets', 'users', 'loggedUser'));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'user_id' => 'required|exists:users,id',
            'phone_number' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'reason_to_join' => 'required|string',
            'information_source' => 'required|string',
            'referral' => 'required|string',
        ]);

        // Check if ticket is already used
        $isTicketUsed = UserDetail::where('ticket_id', $data['ticket_id'])->exists();
        if ($isTicketUsed) {
            return redirect()->back()->withErrors(['ticket_id' => 'Ticket is already in use']);
        }

        UserDetail::create($data);

        return redirect()->route('user_details.index')->with('success', 'User Detail created successfully');
    }

    public function edit($id)
    {
        $userDetail = UserDetail::findOrFail($id);
        $tickets = Ticket::all();
        $users = User::all();
        
        return view('user_details.edit', compact('userDetail', 'tickets', 'users'));
    }

    public function update(Request $request, $id)
    {
        $userDetail = UserDetail::findOrFail($id);

        $data = $request->validate([
            'ticket_id' => 'sometimes|exists:tickets,id',
            'user_id' => 'sometimes|exists:users,id',
            'phone_number' => 'sometimes|string|max:15',
            'address' => 'sometimes|string|max:255',
        ]);

        // If ticket_id is being changed, check if new ticket is already in use
        if (isset($data['ticket_id']) && $data['ticket_id'] !== $userDetail->ticket_id) {
            $isTicketUsed = UserDetail::where('ticket_id', $data['ticket_id'])->exists();
            if ($isTicketUsed) {
                return redirect()->back()->withErrors(['ticket_id' => 'Ticket is already in use']);
            }
        }

        $userDetail->update($data);

        return redirect()->route('user_details.index')->with('success', 'User Detail updated successfully');
    }

    public function destroy($id)
    {
        $userDetail = UserDetail::findOrFail($id);
        $userDetail->delete();

        return redirect()->route('user_details.index')->with('success', 'User Detail deleted successfully');
    }

    public function certificate($id)
    {
        $userDetail = UserDetail::with(['ticket', 'user'])->findOrFail($id);
        return view('user_details.certificate', compact('userDetail'));
    }

    public function exportPdf($id)
    {
        $userDetail = UserDetail::with(['ticket', 'user'])->findOrFail($id);

        $html = view('user_details.certificate', compact('userDetail'))->render();
        $pdf = Pdf::loadHTML($html)->setPaper('a4', 'landscape');

        return $pdf->download("certificate_{$userDetail->user->name}_{$userDetail->ticket_id}.pdf");
    }
    
    public function exportExcel()
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\UserDetailsExport, 'user_details.xlsx');
    }
    
}
