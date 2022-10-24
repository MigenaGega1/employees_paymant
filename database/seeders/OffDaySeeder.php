<?php

namespace Database\Seeders;

use App\Models\OffDay;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OffDaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('off_days')->delete();

        OffDay::create(
          [

              'date'=>'2022-01-01',
          ]
          );
          OffDay::create(
              [

              'date'=>'2022-01-02',
              ]
              );
          OffDay::create(
          [

              'date'=>'2022-01-12',
          ]
          );
          OffDay::create(
          [

              'date'=>'2022-01-13',
          ]
          );
    }
}
