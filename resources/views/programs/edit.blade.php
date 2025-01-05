@extends('layouts.app')

@section('content')
    <h1>Edit Program</h1>
    <form action="{{ route('programs.update', $program->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nama Program</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $program->name) }}" required>
        </div>
        <div class="mb-3">
            <label for="label" class="form-label">Label</label>
            <input type="text" id="label" name="label" class="form-control" value="{{ old('label', $program->label) }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea id="description" name="description" class="form-control" rows="3" required>{{ old('description', $program->description) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="code" class="form-label">Kode</label>
            <input type="text" id="code" name="code" class="form-control" value="{{ old('code', $program->code) }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
