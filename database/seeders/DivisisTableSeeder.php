<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DivisisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $divisis = collect(
            ['Admin SDM', 'Konveksi dan Sablonase', 'Swalayan', 'Warparpostel', 'Non Divisi',
            'Ketua Umum', 'Pengawas', 'Bidang Keanggotaan', 'Bidang Bisnis', 'Bidang SDM', 'Bidang Keuangan',
            'Bidang Humas', 'Bidang Medkref', 'Bidang Ristek', 'Bidang Adum',
            ]
        );
        $divisis->each(function ($c) {
            \App\Models\Divisi::create([
                'nama' => $c
            ]);
        });
    }
}
