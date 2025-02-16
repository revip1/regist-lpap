@extends('layouts.app')

@section('header-title', 'Edit User Detail')
@section('breadcrumb', 'Edit User Detail')

@section('content')
<div class="container">
    <h2>Form Edit User Detail</h2>
    <form action="{{ route('user_details.update', $userDetail->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="full_name" class="form-label">Nama Lengkap</label>
            <input type="text" name="full_name" id="full_name" class="form-control" value="{{ $userDetail->full_name }}" required>
        </div>
        <div class="mb-3">
            <label for="whatsapp_number" class="form-label">Nomor Whatsapp</label>
            <input type="text" name="whatsapp_number" id="whatsapp_number" class="form-control" value="{{ $userDetail->whatsapp_number }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $userDetail->email }}" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Alamat Lengkap</label>
            <input type="text" name="address" id="address" class="form-control" value="{{ $userDetail->address }}" required>
        </div>
        <div class="mb-3">
            <label for="occupation" class="form-label">Pekerjaan</label>
            <input type="text" name="occupation" id="occupation" class="form-control" value="{{ $userDetail->occupation }}" required>
        </div>
        <div class="mb-3">
            <label for="institution" class="form-label">Asal Instansi</label>
            <input type="text" name="institution" id="institution" class="form-control" value="{{ $userDetail->institution }}" required>
        </div>
        
        <div class="mb-3">
            <label for="reason" class="form-label">Alasan Mengikuti</label>
            <input type="text" name="reason" id="reason" class="form-control" value="{{ $userDetail->reason }}" required>
        </div>
        <div class="mb-3">
            <label for="source_of_info" class="form-label">Sumber Informasi</label>
            <input type="text" name="source_of_info" id="source_of_info" class="form-control" value="{{ $userDetail->source_of_info }}" required>
        </div>
        <div class="mb-3">
            <label for="referral" class="form-label">Referral</label>
            <input type="text" name="referral" id="referral" class="form-control" value="{{ $userDetail->referral }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
