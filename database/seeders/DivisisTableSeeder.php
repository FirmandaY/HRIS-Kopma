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
        $divisis = collect(['Admin SDM', 'Konveksi dan Sablonase', 'Swalayan', 'Warparpostel', 'Non Divisi']);
        $divisis->each(function ($c) {
            \App\Models\Divisi::create([
                'nama' => $c
            ]);
        });
    }
}
