@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Request Program List</h1>
    <a href="{{ route('request-program.create') }}" class="btn btn-primary">Create New</a>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Place</th>
                <th>Message</th>
                <th>Phone Number</th>
                <th>Estimated Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->place }}</td>
                    <td>{{ $item->message }}</td>
                    <td>{{ $item->phone_number }}</td>
                    <td>{{ $item->estimated_date }}</td>
                    <td>
                        <a href="{{ route('request-program.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('request-program.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
