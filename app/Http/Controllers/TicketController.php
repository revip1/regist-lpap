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
        $ticket = Ticket::latest()->paginate(10);
        return response()->json(['message' => 'Data Spesialis berhasil diambil', 'data' => $ticket], HttpResponse::HTTP_OK);
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

        $uniqueCode = "LPAP-{$programCode}{$data['batch']}{$year}-{$participantNumber}";

        $ticket = Ticket::create([
            'program_id' => $data['program_id'],
            'batch' => $data['batch'],
            'unique_code' => $uniqueCode
        ]);

        return response()->json([
            'message' => 'Data Ticket berhasil ditambahkan',
            'data' => $ticket
        ], 201);

    }
}
