<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class KategorisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kategoris = collect(['Cuti Tahunan', 'Cuti Haid', 'Cuti Melahirkan']);
        $kategoris->each(function ($c) {
            \App\Models\Kategori::create([
                'nama' => $c
            ]);
        });
    }
}
