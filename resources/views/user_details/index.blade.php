@extends('layouts.app')

@section('header-title', 'Daftar Registrasi Kelas')
@section('breadcrumb', 'Registrasi Kelas')

@section('content')
<div class="container">
    <h2>Daftar Registrasi Kelas</h2>
    
    <div class="row mb-3">
        <div class="col">
            <a href="{{ route('user_details.create') }}" class="btn btn-primary">Tambah Registrasi Kelas</a>
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
                <div class="col-md-6">
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
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
            </form>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Nomor WhatsApp</th>
                <th>Email</th>
                <th>Program</th>
                <th>Download Certificate</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($userDetails as $userDetail)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $userDetail->name }}</td>
                    <td>{{ $userDetail->phone_number }}</td>
                    <td>{{ $userDetail->email }}</td>
                    <td>{{ $userDetail->program->name ?? 'Tidak tersedia' }}</td>
                    <td>
                        <a href="{{ route('export_pdf', $userDetail->id) }}" class="btn btn-success btn-sm">
                            Download Certificate
                        </a>                        
                    </td>
                    <td>
                        <a href="{{ route('user_details.edit', $userDetail->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('user_details.destroy', $userDetail->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    {{ $userDetails->links() }}
</div>
@endsection
