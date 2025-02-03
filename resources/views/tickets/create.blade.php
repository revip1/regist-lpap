@extends('layouts.app')

@section('header-title', 'Tambah Tiket')
@section('breadcrumb', 'Tambah Tiket')

@section('content')
<div class="card">
    <div class="card-header">Tambah Tiket Baru</div>
    <div class="card-body">
        <form action="{{ route('tickets.store') }}" method="POST">
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
                <label for="batch_id" class="form-label">Gelombang</label>
                <select name="batch_id" id="batch_id" class="form-select" required>
                    <option value="" disabled selected>Pilih Gelombang</option>
                    @foreach ($batches as $batch)
                        <option value="{{ $batch->id }}">{{ $batch->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="year">Tahun</label>
                <input type="text" class="form-control" name="year" id="year" value="{{ old('year', $ticket->year ?? '') }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection
