<?php

namespace App\Exports;

use App\Models\UserDetail;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserDetailsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return UserDetail::with('ticket')->get()->map(function ($userDetail) {
            return [
                'Nama Lengkap' => $userDetail->full_name,
                'Nomor WhatsApp' => $userDetail->whatsapp_number,
                'Email' => $userDetail->email,
                'Alamat' => $userDetail->address,
                'Pekerjaan' => $userDetail->occupation,
                'Institusi' => $userDetail->institution,
                'Alasan' => $userDetail->reason,
                'Sumber Informasi' => $userDetail->source_of_info,
                'Referensi' => $userDetail->referral,
                'Kode Tiket' => $userDetail->ticket->unique_code ?? 'Tidak tersedia',
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
            'Pekerjaan',
            'Institusi',
            'Alasan',
            'Sumber Informasi',
            'Referensi',
            'Kode Tiket',
        ];
    }
}
