<?php

namespace App\Exports;

use App\Models\Izin;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class IzinExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Izin::with('user')->get();
    }
    public function map($izin): array
    {
        return [
            $izin->user->name ?? 'None',
            $izin->user->nik ?? 'None',
            $izin->user->role->nama ?? 'None',
            $izin->user->divisi->nama ?? 'None',
            Carbon::parse($izin->created_at)->toFormattedDateString(),
            Carbon::parse($izin->tgl_izin)->toFormattedDateString(),
            $izin->wkt_mulai,
            $izin->wkt_selesai,
            $izin->acc_mandiv->nama,
            $izin->acc_hrd->nama,
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
            'Tanggal Izin',
            'Mulai',
            'Selesai',
            'Acc Mandiv',
            'Acc HRD'
        ];
    }
}
