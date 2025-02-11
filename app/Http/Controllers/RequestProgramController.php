<?php

namespace App\Http\Controllers;

use App\Models\RequestProgram;
use Illuminate\Http\Request;

class RequestProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = RequestProgram::all();
        return view("request-program.index", compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("request-program.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'place' => 'required',
            'message' => 'required',
            'phone_number' => 'required',
            'estimated_date' => 'required|date',
        ]);

        RequestProgram::create($data);
        return redirect()->back()->with("success", "Request Program created successfully.");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RequestProgram $requestProgram)
    {
        return view("request-program.edit", compact("requestProgram"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RequestProgram $requestProgram)
    {
        $data = $request->validate([
            'name' => 'required',
            'place' => 'required',
            'message' => 'required',
            'phone_number' => 'required',
            'estimated_date' => 'required|date',
        ]);

        $requestProgram->update($data);
        return redirect()->route("request-program.index")->with("success", "Request Program updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RequestProgram $requestProgram)
    {
        $requestProgram->delete();
        return redirect()->route("request-program.index")->with("success", "Request Program deleted successfully.");
    }
}
