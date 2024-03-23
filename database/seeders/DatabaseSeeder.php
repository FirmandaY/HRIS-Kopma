<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(KategorisTableSeeder::class);
        $this->call(DivisisTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(Acc_hrdsTableSeeder::class);
        $this->call(Acc_mandivsTableSeeder::class);
        $this->call(Acc_adminkeusTableSeeder::class);
        $this->call(AdminkeuTableSeeder::class);
        $this->call(CutisTableSeeder::class);
    }
}
