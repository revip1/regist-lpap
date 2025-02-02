@extends('layouts.app')

@section('header-title', 'Daftar User Detail')
@section('breadcrumb', 'User Detail')

@section('content')
<div class="container">
    <h2>Daftar User Detail</h2>
    <a href="{{ route('user_details.create') }}" class="btn btn-primary mb-3">Tambah User Detail</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('user_details.export-excel') }}" class="btn btn-success mb-3">Export to Excel</a>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Lengkap</th>
                <th>Nomor WhatsApp</th>
                <th>Email</th>
                <th>Kode Tiket</th>
                <th>Sertifikat</th>
                <th>Export PDF</th> <!-- New Column for Export PDF -->
            </tr>
        </thead>
        <tbody>
            @foreach($userDetails as $userDetail)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $userDetail->full_name }}</td>
                    <td>{{ $userDetail->whatsapp_number }}</td>
                    <td>{{ $userDetail->email }}</td>
                    <td>{{ $userDetail->ticket->unique_code ?? 'Tiket tidak tersedia' }}</td>
                    <td>
                        @if($userDetail->ticket)
                            <a href="{{ route('user_details.certificate', $userDetail->id) }}" target="_blank" class="btn btn-primary">
                                Lihat Sertifikat
                            </a>
                        @else
                            <span class="text-danger">Sertifikat tidak tersedia</span>
                        @endif
                    </td>
                    <td> <!-- Export PDF Button -->
                        @if($userDetail->ticket)
                            <a href="{{ route('user_details.export-pdf', $userDetail->id) }}" class="btn btn-success">
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
