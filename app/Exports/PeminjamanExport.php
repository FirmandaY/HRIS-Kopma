<?php

namespace App\Exports;

use App\Models\Peminjaman;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\withHeadings;
use Maatwebsite\Excel\Concerns\withMapping;

class IzinExport implements FromCollection, withMapping, withHeadings
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
            $peminjaman->user->name,
            $peminjaman->user->nik,
            $peminjaman->user->role->nama,
            $peminjaman->user->divisi->nama,
            Carbon::parse($peminjaman->created_at)->toFormattedDateString(),
            Carbon::parse($peminjaman->tgl_izin)->toFormattedDateString(),
            $peminjaman->wkt_mulai,
            $peminjaman->wkt_selesai,
            $peminjaman->acc_mandiv->nama,
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
            'Mengajukan',
            'Tanggal Peminjaman',
            'Mulai',
            'Selesai',
            'Acc Mandiv',
            'Acc HRD'
        ];
    }
}
