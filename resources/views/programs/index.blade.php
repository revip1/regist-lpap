@extends('layouts.app')

@section('content')
    <h1>Programs</h1>
    <a href="{{ route('programs.create') }}" class="btn btn-primary mb-3">Add Program</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Program</th>
                <th>Label</th>
                <th>Deskripsi</th>
                <th>Membutuhkan Referral</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($programs as $program)
                <tr>
                    <td>{{ $program->id }}</td>
                    <td>{{ $program->name }}</td>
                    <td>{{ $program->label }}</td>
                    <td>{{ $program->description }}</td>
                    <td>{{ $program->referral_required }}</td>
                    <td>
                        @if($program->status == 'active')
                            <span class="badge bg-success">Aktif</span>
                        @else
                            <span class="badge bg-secondary">Tidak Aktif</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('programs.edit', $program->id) }}" class="btn btn-warning">Edit</a>
                        <button type="button" class="btn btn-danger delete-button" data-id="{{ $program->id }}">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div>
        {{ $programs->links() }}
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const deleteButtons = document.querySelectorAll('.delete-button');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const programId = this.getAttribute('data-id');
                    
                    Swal.fire({
                        title: 'Konfirmasi Nonaktif',
                        html: `
                            <form id="delete-form-${programId}" method="POST" action="/programs/${programId}">
                                @csrf
                                @method('DELETE')
                                <div class="mb-3">
                                    <label for="password" class="form-label">Masukkan Password Anda</label>
                                    <input type="password" class="form-control" id="password-${programId}" name="password" required>
                                </div>
                            </form>
                        `,
                        showCancelButton: true,
                        confirmButtonText: 'Hapus',
                        cancelButtonText: 'Batal',
                        confirmButtonColor: '#dc3545',
                        showLoaderOnConfirm: true,
                        preConfirm: () => {
                            const password = document.getElementById(`password-${programId}`).value;
                            if (!password) {
                                Swal.showValidationMessage('Password harus diisi');
                                return false;
                            }
                            
                            return document.getElementById(`delete-form-${programId}`).submit();
                        }
                    });
                });
            });

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '{{ session('error') }}'
                });
            @endif

            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '{{ session('success') }}'
                });
            @endif
        });
    </script>
@endsection