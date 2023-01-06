<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
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
                'name' => 'Admin HRD',
                'role_id' => 1,
                'divisi_id' => 1,
                'nik' => 'masteradminhc',
                'tgl_lahir' => now(),
                'gender' => 'Pria',
                'no_hp' => '081828384858',
                'password' => bcrypt('kopmaugmhc2021'),
                'email' => 'admin@mail.com'
            ]
        );
    }
}
