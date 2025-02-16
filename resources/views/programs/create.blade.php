@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Pembuatan Program LPAP</h1>
        <form action="{{ route('programs.store') }}" method="POST">
            @csrf
            <div class="card p-4">
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Program</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Nama Program" required>
                </div>
                <div class="mb-3">
                    <label for="label" class="form-label">Label</label>
                    <input type="text" id="label" name="label" class="form-control" placeholder="Label" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea id="description" name="description" class="form-control" rows="3" placeholder="Deskripsi" required></textarea>
                </div>
                <div class="mb-4">
                    <label class="form-label">Apakah Referral Diperlukan?</label>
                    <div class="d-flex gap-3">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="referral_required" id="referral_yes" value="yes" {{ old('referral_required') == 'yes' ? 'checked' : '' }}>
                            <label class="form-check-label" for="referral_yes">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="referral_required" id="referral_no" value="no" {{ old('referral_required') == 'no' ? 'checked' : '' }}>
                            <label class="form-check-label" for="referral_no">No</label>
                        </div>
                    </div>
                </div>                
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session("success") }}',
            confirmButtonText: 'OK'
        });
    </script>
@endif
@endsection
