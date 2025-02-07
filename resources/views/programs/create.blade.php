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
                <div class="mb-3">
                    <label for="place" class="form-label">Tempat Pelaksanaan</label>
                    <input type="text" id="place" name="place" class="form-control" placeholder="Tempat" required>
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
