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
                'nik' => 'adminhrd',
                'tgl_lahir' => now(),
                'gender' => 'Pria',
                'no_hp' => '081828384858',
                'password' => bcrypt('password'),
                'email' => 'admin@mail.com'
            ]
        );
        \App\Models\User::create(
            [
                'name' => 'Harry',
                'role_id' => 2,
                'divisi_id' => 2,
                'nik' => '19800731',
                'tgl_lahir' => now(),
                'gender' => 'Pria',
                'no_hp' => '081828384868',
                'password' => bcrypt('password'),
                'email' => 'harry@mail.com'
            ]
        );
        \App\Models\User::create(
            [
                'name' => 'Malfoy',
                'role_id' => 3,
                'divisi_id' => 2,
                'nik' => '19800605',
                'tgl_lahir' => now(),
                'gender' => 'Pria',
                'no_hp' => '081828384878',
                'password' => bcrypt('password'),
                'email' => 'malfoy@mail.com'
            ]
        );
    }
}
