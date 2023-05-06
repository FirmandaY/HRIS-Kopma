<?php

namespace App\Exports;

use App\Models\Cuti;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CutiExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Cuti::with('user')->get();
    }
    public function map($cuti): array
    {
        return [
            $cuti->user->name ?? 'None',
            $cuti->user->nik ?? 'None',
            $cuti->user->role->nama ?? 'None',
            $cuti->user->divisi->nama ?? 'None',
            Carbon::parse($cuti->created_at)->toFormattedDateString(),
            Carbon::parse($cuti->tgl_mulai)->toFormattedDateString(),
            Carbon::parse($cuti->tgl_selesai)->toFormattedDateString(),
            $cuti->acc_mandiv->nama ?? 'None',
            $cuti->acc_hrd->nama ?? 'None',
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
            'Mulai',
            'Selesai',
            'Acc Mandiv',
            'Acc HRD'
        ];
    }
}
