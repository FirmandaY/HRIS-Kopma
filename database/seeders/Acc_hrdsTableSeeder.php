<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class Acc_hrdsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $divisis = collect(['Diproses', 'Ditolak', 'Disetujui', 'Menunggu Konfirmasi Mandiv']);
        $divisis->each(function ($c) {
            \App\Models\Acc_hrd::create([
                'nama' => $c
            ]);
        });
    }
}
