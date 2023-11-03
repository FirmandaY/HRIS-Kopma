<?php

namespace App\Exports;

use App\Models\Peminjaman;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PeminjamanExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Peminjaman::with('user')->get();
    }
    public function map($peminjaman): array
    {
        return [
            $peminjaman->user->name ?? 'None',
            $peminjaman->user->nik ?? 'None',
            $peminjaman->user->role->nama ?? 'None',
            $peminjaman->user->divisi->nama ?? 'None',
            Carbon::parse($peminjaman->created_at)->toFormattedDateString(),
            $peminjaman->acc_hrd->nama,
        ];
    }
    public function headings(): array
    {
        return [
            'Nama',
            'NIK',
            'Jabatan',
            'Divisi',
            'Tanggal Peminjaman',
            'Acc HRD'
        ];
    }
}
