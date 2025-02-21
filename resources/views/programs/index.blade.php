@extends('layouts.app')

@section('breadcrumb', 'Programs')

@section('content')
    <div class="container">
        <h1>Programs</h1>
        <a href="{{ route('programs.create') }}" class="btn btn-primary mb-3">Add Program</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Label</th>
                    <th>Description</th>
                    <th>Referral Required</th>
                    <th>Status</th>
                    <th>Actions</th>
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
                        <td>{{ $program->status}}</td>
                        <td>
                            <a href="{{ route('programs.edit', $program->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('programs.destroy', $program->id) }}" method="POST" class="d-inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger delete-button" data-id="{{ $program->id }}">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div>
            {{ $programs->links() }}
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const deleteButtons = document.querySelectorAll('.delete-button');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const form = this.closest('.delete-form');
                    const programId = this.getAttribute('data-id');

                    Swal.fire({
                        title: "Apakah Anda yakin?",
                        text: "Program ini akan dinonaktifkan, bukan dihapus permanen!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Ya, Nonaktifkan!",
                        cancelButtonText: "Batal"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
