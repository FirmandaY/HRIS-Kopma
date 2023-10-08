<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class Acc_adminkeusTableSeeder extends Seeder
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
            \App\Models\Acc_hrd::create([
                'nama' => $c
            ]);
        });
    }
}