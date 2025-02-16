@extends('layouts.app')

@section('breadcrumb', 'Batches')

@section('content')
    <div class="container">
        <h1>Batch</h1>
        <a href="{{ route('batches.create') }}" class="btn btn-primary mb-3">Tambah Batch</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Program</th>
                    <th>Batch</th>
                    <th>Limit</th>
                    <th>Estimated Time</th>
                    <th>Program Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($batches as $batch)
                    <tr>
                        <td>{{ $batch->id }}</td>
                        <td>{{ $batch->program->name }}</td>
                        <td>{{ $batch->name }}</td>
                        <td>{{ $batch->limit }}</td>
                        <td>{{ $batch->estimated_time }}</td>
                        <td>{{ implode(', ', json_decode($batch->program_type, true)) }}</td>
                        <td>
                            <a href="{{ route('batches.edit', $batch->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('batches.destroy', $batch->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div>
            {{ $batches->links() }}
        </div>
        <script>
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses!',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 2000
                });
            @endif
            
            @if ($errors->has('batch'))
            Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: "{{ $errors->first('batch') }}",
                    showConfirmButton: true
                });
            @endif

    
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const batchId = this.getAttribute('data-id');
    
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Data batch akan dihapus secara permanen!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`{{ url('batches') }}/${batchId}`, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({ _method: 'DELETE' })
                            }).then(response => {
                                if (response.ok) {
                                    Swal.fire(
                                        'Deleted!',
                                        'Batch berhasil dihapus.',
                                        'success'
                                    ).then(() => {
                                        location.reload();
                                    });
                                }
                            });
                        }
                    });
                });
            });
        </script>
    </div>
    
@endsection
