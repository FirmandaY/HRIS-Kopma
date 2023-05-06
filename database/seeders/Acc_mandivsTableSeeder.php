<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class Acc_mandivsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $divisis = collect(['Diproses', 'Ditolak', 'Disetujui']);
        $divisis->each(function ($c) {
            \App\Models\Acc_mandiv::create([
                'nama' => $c
            ]);
        });
    }
}
