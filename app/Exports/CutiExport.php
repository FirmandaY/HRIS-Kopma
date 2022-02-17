<?php

namespace App\Exports;

use App\Models\Cuti;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\withHeadings;
use Maatwebsite\Excel\Concerns\withMapping;

class CutiExport implements FromCollection, withMapping, withHeadings
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
            $cuti->user->name,
            $cuti->user->nik,
            $cuti->user->role->nama,
            $cuti->user->divisi->nama,
            Carbon::parse($cuti->created_at)->toFormattedDateString(),
            Carbon::parse($cuti->tgl_mulai)->toFormattedDateString(),
            Carbon::parse($cuti->tgl_selesai)->toFormattedDateString(),
            $cuti->acc_mandiv->nama,
            $cuti->acc_hrd->nama,
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
