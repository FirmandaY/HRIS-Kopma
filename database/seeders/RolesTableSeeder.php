<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = collect(['Admin', 'Manajer Divisi', 'Karyawan', 'Pengurus']);
        $roles->each(function ($c) {
            \App\Models\Role::create([
                'nama' => $c
            ]);
        });
    }
}
