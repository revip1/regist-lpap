@extends('layouts.app')

@section('header-title', 'Tambah User Detail')
@section('breadcrumb', 'Tambah User Detail')

@section('content')
<div class="container">
    <h2>Registrasi User LPAP</h2>
    <form action="{{ route('user_details.store') }}" method="POST">
        @csrf
        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
        <div class="mb-3">
            <label for="full_name" class="form-label">Nama Lengkap</label>
            <input type="text" name="full_name" id="full_name" class="form-control" value="{{ old('full_name', $loggedUser->name) }}" required>
        </div>
        <div class="mb-3">
            <label for="phone_number" class="form-label">Nomor Whatsapp</label>
            <input type="text" name="phone_number" id="phone_number" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $loggedUser->email) }}" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Alamat Lengkap</label>
            <input type="text" name="address" id="address" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="occupation" class="form-label">Pekerjaan</label>
            <input type="text" name="occupation" id="occupation" class="form-control" value="{{ old('occupation', $loggedUser->occupation) }}" required>
        </div>
        <div class="mb-3">
            <label for="instance" class="form-label">Asal Instansi</label>
            <input type="text" name="instance" id="instance" class="form-control" value="{{ old('instance', $loggedUser->instance)}}" required>
        </div>
        <div class="mb-3">
            <label for="reason_to_join" class="form-label">Alasan Mengikuti</label>
            <input type="text" name="reason_to_join" id="reason_to_join" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="ticket_id" class="form-label">Tiket Pelatihan</label>
            <select id="ticket_id" name="ticket_id" class="form-control" required>
                <option value="" disabled selected>Pilih Tiket</option>
                @foreach($tickets as $ticket)
                    <option value="{{ $ticket->id }}">{{ $ticket->unique_code }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-3">
            <label for="information_source" class="form-label">Sumber Informasi</label>
            <input type="text" name="information_source" id="information_source" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="referral" class="form-label">Referral</label>
            <input type="text" name="referral" id="referral" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
