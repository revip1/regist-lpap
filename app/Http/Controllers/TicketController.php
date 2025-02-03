<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Batch;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;

class TicketController extends Controller
{
    public function index() {
        $tickets = Ticket::with(['program', 'batch'])->get();
        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        $programs = Program::all();
        $batches = Batch::all();
        return view('tickets.create', compact('programs', 'batches'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'program_id' => 'required|exists:programs,id',
            'batch_id' => 'required|exists:batches,id',
            'year' => 'required|digits:4', // validasi tahun (4 digit)
        ]);
    
        $program = Program::findOrFail($data['program_id']);
        $batch = Batch::findOrFail($data['batch_id']);
        $programCode = $program->code;
        
        $year = $data['year'];  // menggunakan input manual untuk tahun
        $existingTicketsCount = Ticket::where('program_id', $program->id)
            ->where('batch_id', $batch->id)
            ->where('year', $year)
            ->count();
    
        $participantNumber = str_pad($existingTicketsCount + 1, 3, '0', STR_PAD_LEFT);
    
        $uniqueCode = "LPAP-{$programCode}G{$batch->name}{$year}-{$participantNumber}";
    
        Ticket::create([
            'program_id' => $data['program_id'],
            'batch_id' => $data['batch_id'],
            'year' => $year,
            'unique_code' => $uniqueCode
        ]);
    
        return redirect()->route('tickets.index')->with('success', 'Data Ticket berhasil ditambahkan!');
    }
    

    public function show($id) {
        $ticket = Ticket::with(['program', 'batch'])->find($id);
        if ($ticket) {
            return response()->json(['message' => 'Data Ticket berhasil diambil', 'data' => $ticket], HttpResponse::HTTP_OK);
        } else {
            return response()->json(['message' => 'Data Ticket tidak ditemukan'], HttpResponse::HTTP_NOT_FOUND);
        }
    }

    public function edit($id)
    {
        $ticket = Ticket::findOrFail($id);
        $programs = Program::all();
        $batches = Batch::all();
        return view('tickets.edit', compact('ticket', 'programs', 'batches'));
    }

    public function update(Request $request, $id) {
        $data = $request->validate([
            'program_id' => 'sometimes|exists:programs,id',
            'batch_id' => 'sometimes|exists:batches,id',
        ]);

        $ticket = Ticket::find($id);
        if ($ticket) {
            $ticket->update($data);
            return redirect()->route('tickets.index')->with('success', 'Data Ticket berhasil diperbarui!');
        } else {
            return redirect()->route('tickets.edit')->with('error', 'Data Ticket tidak berhasil diperbarui!');
        }
    }

    public function destroy($id) {
        $ticket = Ticket::find($id);
        if ($ticket) {
            $ticket->delete();
            return redirect()->route('tickets.index')->with('success', 'Data Ticket berhasil dihapus!');
        } else {
            return redirect()->route('tickets.index')->with('error', 'Data Ticket gagal dihapus!');
        }
    }
}
