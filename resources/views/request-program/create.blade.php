@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Create Request Program</h1>
        <form action="{{ route('request-program.store') }}" method="POST">
            @csrf
            <div class="card p-4">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Enter name" required>
                </div>
                
                <div class="mb-3">
                    <label for="place" class="form-label">Place</label>
                    <input type="text" id="place" name="place" class="form-control" placeholder="Enter place" required>
                </div>
                
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea id="message" name="message" class="form-control" rows="3" placeholder="Enter message" required></textarea>
                </div>
                
                <div class="mb-3">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input type="number" id="phone_number" name="phone_number" class="form-control" placeholder="Enter phone number" required>
                </div>
                
                <div class="mb-3">
                    <label for="estimated_date" class="form-label">Estimated Date</label>
                    <input type="date" id="estimated_date" name="estimated_date" class="form-control" required>
                </div>
                
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session("success") }}',
            confirmButtonText: 'OK'
        });
    </script>
    @endif
@endsection