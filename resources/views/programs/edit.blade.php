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

        <div class="mb-4">
            <label class="form-label">Apakah Referral Diperlukan?</label>
            <div class="d-flex gap-3">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="referral_required" id="referral_yes" value="yes" 
                        {{ old('referral_required', $program->referral_required) == 'yes' ? 'checked' : '' }}>
                    <label class="form-check-label" for="referral_yes">Ya</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="referral_required" id="referral_no" value="no" 
                        {{ old('referral_required', $program->referral_required) == 'no' ? 'checked' : '' }}>
                    <label class="form-check-label" for="referral_no">Tidak</label>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <label for="status" class="form-label">Status</label>
            <select id="status" name="status" class="form-select">
                <option value="active" {{ old('status', $program->status) == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status', $program->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
