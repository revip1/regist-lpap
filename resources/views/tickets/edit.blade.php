@extends('layouts.app')

@section('header-title', 'Edit Tiket')
@section('breadcrumb', 'Edit Tiket')

@section('content')
<div class="card">
    <div class="card-header">Edit Tiket</div>
    <div class="card-body">
        <form action="{{ route('tickets.update', $ticket->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="program_id" class="form-label">Program</label>
                <select name="program_id" id="program_id" class="form-select">
                    @foreach ($programs as $program)
                    <option value="{{ $program->id }}" {{ $ticket->program_id == $program->id ? 'selected' : '' }}>{{ $program->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="batch_id" class="form-label">Gelombang</label>
                <select name="batch_id" id="batch_id" class="form-select" required>
                    @foreach ($batches as $batch)
                        <option value="{{ $batch->id }} {{ $ticket->batch_id == $batch->id ? 'selected' : '' }}">{{ $batch->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
</div>
@endsection
