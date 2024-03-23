<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminkeuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \App\Models\User::create(
            [
                'name' => 'Adminkeu Kopma UGM',
                'role_id' => 5,
                'divisi_id' => 16,
                'nik' => 'masteradminkeu',
                'tgl_lahir' => now(),
                'gender' => 'Pria',
                'no_hp' => '081828384858',
                'password' => bcrypt('keukopmaugm2021'),
                'email' => 'keuangan@kopma-ugm.net'
            ]

        );
        
    }
}
