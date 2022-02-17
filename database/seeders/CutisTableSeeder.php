<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CutisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Cuti::create(
            [
                'user_id' => 2,
                'acc_mandiv_id' => 3,
                'acc_hrd_id' => 3,
                'kategori_id' => 1,
                'slug' => 'PriaWaTt',
                'tgl_mulai' => now(),
                'tgl_selesai' => now(),
                'keterangan' => 'harry@mail.com',
                'created_at' => now(),
                'updated_at' => now()
            ]
        );
        \App\Models\Cuti::create(
            [
                'user_id' => 2,
                'acc_mandiv_id' => 1,
                'acc_hrd_id' => 4,
                'kategori_id' => 1,
                'slug' => 'fGiaWaTt',
                'tgl_mulai' => now(),
                'tgl_selesai' => now(),
                'keterangan' => 'dua',
                'created_at' => now(),
                'updated_at' => now()
            ]
        );
        \App\Models\Cuti::create(
            [
                'user_id' => 3,
                'acc_mandiv_id' => 2,
                'acc_hrd_id' => 2,
                'kategori_id' => 1,
                'slug' => 'PriaWasA',
                'tgl_mulai' => now(),
                'tgl_selesai' => now(),
                'keterangan' => 'malfoy@mail.com',
                'created_at' => now(),
                'updated_at' => now()
            ]
        );
    }
}
