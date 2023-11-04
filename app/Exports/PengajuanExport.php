<?php

namespace App\Exports;

use App\Models\Pengajuan_anggaran;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PengajuanExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Pengajuan_anggaran::with('user')->get();
    }
    public function map($pengajuan): array
    {
        return [
            $pengajuan->user->name ?? 'None',
            $pengajuan->user->nik ?? 'None',
            $pengajuan->user->email ?? 'None',
            $pengajuan->nama_user ?? 'None',
            $pengajuan->no_tlp ?? 'None',
            Carbon::parse($pengajuan->created_at)->toFormattedDateString(),
            $pengajuan->acc_adminkeu->nama,
        ];
    }
    public function headings(): array
    {
        return [
            'Nama Bidang',
            'NIK / NAK / Kode Bidang',
            'Email Bidang',
            'Staf Pemohon',
            'Nomor Telepon',
            'Tanggal Pengajuan',
            'Status'
        ];
    }
}
