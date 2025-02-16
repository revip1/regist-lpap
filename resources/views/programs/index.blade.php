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
                        <td>
                            <a href="{{ route('programs.edit', $program->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('programs.destroy', $program->id) }}" method="POST" style="display:inline-block;">
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
            {{ $programs->links() }}
        </div>
    </div>
@endsection
