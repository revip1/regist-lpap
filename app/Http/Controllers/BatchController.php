<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    public function index($id){
        $batch = Batch::find($id);
        return view('batches.index', compact('batch'));
    }

    
}
