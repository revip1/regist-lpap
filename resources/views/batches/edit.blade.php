@extends('layouts.app')

@section('header-title', 'Edit Batch')
@section('breadcrumb', 'Edit Batch')

@section('content')
<div class="card">
    <div class="card-header">Edit Batch</div>
    <div class="card-body">
        <form action="{{ route('batches.update', $batch->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="program_id" class="form-label">Program</label>
                <select name="program_id" id="program_id" class="form-select">
                    @foreach ($programs as $program)
                    <option value="{{ $program->id }}" {{ $batch->program_id == $program->id ? 'selected' : '' }}>{{ $program->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Nama Batch</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $batch->name }}" required>
            </div>
            <div class="mb-3">
                <label for="limit" class="form-label">Limit</label>
                <input type="number" name="limit" id="limit" class="form-control" value="{{ $batch->limit }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
</div>
@endsection