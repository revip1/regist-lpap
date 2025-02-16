@extends('layouts.app')

@section('header-title', 'Tambah Batch')
@section('breadcrumb', 'Tambah Batch')

@section('content')
<div class="card">
    <div class="card-header">Tambah Batch</div>
    <div class="card-body">
        <form action="{{ route('batches.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="program_id" class="form-label">Program</label>
                <select name="program_id" id="program_id" class="form-select" required>
                    <option value="" disabled selected>Pilih Program</option>
                    @foreach ($programs as $program)
                        <option value="{{ $program->id }}">{{ $program->name }}</option>
                    @endforeach
                </select>                
            </div>
            
            <div class="mb-3">
                <label for="name" class="form-label">Batch</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="limit" class="form-label">Limit</label>
                <input type="number" name="limit" id="limit" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="estimated_time" class="form-label">Estimated Time</label>
                <input type="date" name="estimated_time" id="estimated_time" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Program Type</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="program_type[]" value="online" id="type_online">
                    <label class="form-check-label" for="type_online">
                        Online
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="program_type[]" value="offline" id="type_offline">
                    <label class="form-check-label" for="type_offline">
                        Offline
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="program_type[]" value="hybrid" id="type_hybrid">
                    <label class="form-check-label" for="type_hybrid">
                        Hybrid
                    </label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>        
    </div>
</div>
@endsection
