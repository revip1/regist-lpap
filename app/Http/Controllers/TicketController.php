<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;

class TicketController extends Controller
{
    public function index() {
        $tickets = Ticket::with('program')->get();
    return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        $programs = Program::all();
        return view('tickets.create', compact('programs'));
    }

    public function store(Request $request) {

        $data = $request->validate([
            'program_id' => 'required|exists:programs,id',
            'batch' => 'required',
        ]);

        $program = Program::findOrFail($data['program_id']);
        $programCode = $program->code;

        $year = Carbon::now()->year;
        $existingTicketsCount = Ticket::where('program_id', $program->id)->where('batch', $data['batch'])->whereYear('created_at', $year)->count();

        $participantNumber = str_pad($existingTicketsCount + 1, 3, '0', STR_PAD_LEFT);

        $uniqueCode = "LPAP-{$programCode}G{$data['batch']}{$year}-{$participantNumber}";

        $ticket = Ticket::create([
            'program_id' => $data['program_id'],
            'batch' => $data['batch'],
            'unique_code' => $uniqueCode
        ]);

        return redirect()->route('tickets.index')->with('success', 'Data Ticket berhasil ditambahkan!');
    }

    public function show($id) {
        $ticket = Ticket::with('program')->find($id);
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
        return view('tickets.edit', compact('ticket', 'programs'));
    }

    public function update(Request $request, $id) {
        $data = $request->validate([
            'program_id' => 'sometimes|exists:programs,id',
            'batch' => 'sometimes',
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
            return redirect()->route('tickets.index')->with('success', 'Data Ticket gagal dihapus!');
        }
    }
}
