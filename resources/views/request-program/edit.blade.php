@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Request Program</h1>
    <form action="{{ route('request-program.update', $requestProgram->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $requestProgram->name }}" required>
        </div>
        <div class="mb-3">
            <label>Place</label>
            <input type="text" name="place" class="form-control" value="{{ $requestProgram->place }}" required>
        </div>
        <div class="mb-3">
            <label>Message</label>
            <textarea name="message" class="form-control" required>{{ $requestProgram->message }}</textarea>
        </div>
        <div class="mb-3">
            <label>Phone Number</label>
            <input type="text" name="phone_number" class="form-control" value="{{ $requestProgram->phone_number }}" required>
        </div>
        <div class="mb-3">
            <label>Estimated Date</label>
            <input type="date" name="estimated_date" class="form-control" value="{{ $requestProgram->estimated_date }}" required>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
