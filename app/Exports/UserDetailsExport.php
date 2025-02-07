<?php

namespace App\Exports;

use App\Models\UserDetail;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserDetailsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return UserDetail::with('program')->get()->map(function ($userDetail) {
            return [
                'Nama Lengkap' => $userDetail->name,
                'Nomor WhatsApp' => $userDetail->phone_number,
                'Email' => $userDetail->email,
                'Alamat' => $userDetail->address,
                'Institusi' => $userDetail->instance,
                'Jenis Identitas' => $userDetail->identity_type ?? 'Tidak tersedia',
                'Nomor Identitas' => $userDetail->identity_number ?? 'Tidak tersedia',
                'Alasan Bergabung' => $userDetail->reason_to_join ?? 'Tidak tersedia',
                'Sumber Informasi' => $userDetail->information_source ?? 'Tidak tersedia',
                'Referensi' => $userDetail->referral ?? 'Tidak tersedia',
                'Program' => $userDetail->program->name ?? 'Tidak tersedia',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama Lengkap',
            'Nomor WhatsApp',
            'Email',
            'Alamat',
            'Institusi',
            'Jenis Identitas',
            'Nomor Identitas',
            'Alasan Bergabung',
            'Sumber Informasi',
            'Referensi',
            'Program',
        ];
    }
}