@extends('layouts.app')

@section('header-title', 'Daftar User Detail')
@section('breadcrumb', 'User Detail')

@section('content')
<div class="container">
    <h2>Daftar User Detail</h2>
    
    <div class="row mb-3">
        <div class="col">
            <a href="{{ route('user_details.create') }}" class="btn btn-primary">Tambah User Detail</a>
            <a href="{{ route('user_details.export-excel') }}" class="btn btn-success">Export to Excel</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Filter Form --}}
    <div class="card mb-3">
        <div class="card-body">
            <form action="{{ route('user_details.index') }}" method="GET" class="row g-3">
                <div class="col-md-5">
                    <label for="program_id" class="form-label">Program</label>
                    <select name="program_id" id="program_id" class="form-select">
                        <option value="">Semua Program</option>
                        @foreach($programs as $program)
                            <option value="{{ $program->id }}" {{ request('program_id') == $program->id ? 'selected' : '' }}>
                                {{ $program->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5">
                    <label for="batch_id" class="form-label">Gelombang</label>
                    <select name="batch_id" id="batch_id" class="form-select">
                        <option value="">Semua Gelombang</option>
                        @foreach($batches as $batch)
                            <option value="{{ $batch->id }}" {{ request('batch_id') == $batch->id ? 'selected' : '' }}>
                                {{ $batch->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">&nbsp;</label>
                    <button type="submit" class="btn btn-primary d-block w-100">Filter</button>
                </div>
            </form>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Lengkap</th>
                <th>Nomor WhatsApp</th>
                <th>Email</th>
                <th>Kode Tiket</th>
                <th>Program</th>
                <th>Gelombang</th>
                <th>Sertifikat</th>
                <th>Export PDF</th>
            </tr>
        </thead>
        <tbody>
            @foreach($userDetails as $userDetail)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $userDetail->user->name ?? 'Tidak tersedia' }}</td>
                    <td>{{ $userDetail->phone_number ?? 'Tidak tersedia' }}</td>
                    <td>{{ $userDetail->user->email ?? 'Tidak tersedia' }}</td>
                    <td>{{ $userDetail->ticket->unique_code ?? 'Tiket tidak tersedia' }}</td>
                    <td>{{ $userDetail->ticket->program->name ?? 'Program tidak tersedia' }}</td>
                    <td>{{ $userDetail->ticket->batch->name ?? 'Gelombang tidak tersedia' }}</td>
                    <td>
                        @if($userDetail->ticket)
                            <a href="{{ route('user_details.certificate', $userDetail->id) }}" target="_blank" class="btn btn-primary btn-sm">
                                Lihat Sertifikat
                            </a>
                        @else
                            <span class="text-danger">Sertifikat tidak tersedia</span>
                        @endif
                    </td>
                    <td>
                        @if($userDetail->ticket)
                            <a href="{{ route('user_details.export-pdf', $userDetail->id) }}" class="btn btn-success btn-sm">
                                Export PDF
                            </a>
                        @else
                            <span class="text-danger">Tidak tersedia</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    {{ $userDetails->links() }}
</div>
@endsection