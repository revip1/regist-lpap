@extends('layouts.app')

@section('header-title', 'Registrasi Kelas')
@section('breadcrumb', 'Registrasi Kelas')

@section('content')
<div class="container">
    <h2>Registrasi</h2>
    <form action="{{ route('user_details.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>
        <div class="mb-3">
            <label for="instance" class="form-label">Instansi</label>
            <input type="text" name="instance" id="instance" class="form-control" value="{{ old('instance') }}" required>
        </div>
        <div class="mb-3">
            <label for="occupation" class="form-label">Pekerjaan</label>
            <input type="text" name="occupation" id="occupation" class="form-control" value="{{ old('occupation') }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Alamat Lengkap</label>
            <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Jenis Identitas</label>
            <div class="d-flex gap-3">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="identity_type" id="ktp" value="KTP" {{ old('identity_type') == 'KTP' ? 'checked' : '' }}>
                    <label class="form-check-label" for="ktp">KTP</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="identity_type" id="sim" value="SIM" {{ old('identity_type') == 'SIM' ? 'checked' : '' }}>
                    <label class="form-check-label" for="sim">SIM</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="identity_type" id="kp" value="KP" {{ old('identity_type') == 'KP' ? 'checked' : '' }}>
                    <label class="form-check-label" for="kp">KTM/Kartu Pelajar</label>
                </div>
            </div>
        </div>               
        <div class="mb-3">
            <label for="identity_number" class="form-label">Nomor Identitas</label>
            <input type="text" name="identity_number" id="identity_number" class="form-control" value="{{ old('identity_number') }}">
        </div>
        <div class="mb-3">
            <label for="phone_number" class="form-label">Nomor Telepon/WhatsApp</label>
            <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ old('phone_number') }}" required>
        </div>
        <div class="mb-3">
            <label for="program_id" class="form-label">Kelas</label>
            <select name="program_id" id="program_id" class="form-control" required>
                <option value="" disabled selected>Pilih Kelas</option>
                @foreach($programs as $program)
                    <option value="{{ $program->id }}">{{ $program->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="reason_to_join" class="form-label">Alasan Mengikuti</label>
            <input type="text" name="reason_to_join" id="reason_to_join" class="form-control" value="{{ old('reason_to_join') }}">
        </div>
        <div class="mb-3">
            <label for="information_source" class="form-label">Sumber Informasi</label>
            <input type="text" name="information_source" id="information_source" class="form-control" value="{{ old('information_source') }}">
        </div>
        <div class="mb-3">
            <label for="referral" class="form-label">Referral</label>
            <input type="text" name="referral" id="referral" class="form-control" value="{{ old('referral') }}">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
{{-- @dd($errors) --}}
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
@if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '{{ session("error") }}',
            confirmButtonText: 'OK'
        });
    </script>
@endif

@endsection
