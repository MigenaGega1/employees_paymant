<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        User::create(
            [
                'full_name'=>'Eduart Torba',
                'total_paga'=>'40000'
            ]
            );
        User::create(
            [
                'full_name'=>'Test User 2',
                'total_paga'=>'60000'
                ]
                );
        User::create(
            [
                'full_name'=>'Test User 3',
                'total_paga'=>'60000'
            ]
            );
    }
}
