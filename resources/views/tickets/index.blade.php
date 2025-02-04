@extends('layouts.app')

@section('header-title', 'Daftar Tiket')
@section('breadcrumb', 'Daftar Tiket')

@section('content')
<div class="card">
    <div class="card-header">Daftar Tiket</div>
    <div class="card-body">
        <a href="{{ route('tickets.create') }}" class="btn btn-primary mb-3">Tambah Tiket</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Program</th>
                    <th>Batch</th>
                    <th>Kode Tiket</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tickets as $ticket)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $ticket->program->name }}</td>
                    <td>{{ $ticket->batch->name }}</td>
                    <td>{{ $ticket->unique_code }}</td>
                    <td>
                        <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data tiket</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
