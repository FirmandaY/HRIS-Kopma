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
        $divisis = collect(['Diproses', 'Ditolak', 'Disetujui', 'Revisi']);
        $divisis->each(function ($c) {
            \App\Models\Acc_adminkeu::create([
                'nama' => $c
            ]);
        });
    }
}
