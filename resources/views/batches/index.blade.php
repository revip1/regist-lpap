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
    </div>
@endsection
