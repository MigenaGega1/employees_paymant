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
        \App\Models\User::factory(23)->create();
//        $this->call(WorkingDaySeeder::class);
//        $this->call(OffDaySeeder::class);
//        $this->call(UserSeeder::class);
        $this->command->info('Database is seeded!');
    }
}
