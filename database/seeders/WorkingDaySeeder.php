<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WorkingDay;
use Illuminate\Support\Facades\DB;

class WorkingDaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

           WorkingDay::create(
              [
              'user_id'=>'1',
              'date'=>'2022-01-11',
              'hours'=>'9'
              ]
              );
          WorkingDay::create(
             [
                'user_id'=>'2',
                'date'=>'2022-01-11',
                'hours'=>'10'
            ]
             );
          WorkingDay::create(
                [
                    'user_id'=>'3',
                    'date'=>'2022-01-11',
                    'hours'=>'5'
                ]
                );
            WorkingDay::create(
                    [
                        'user_id'=>'1',
                        'date'=>'2022-01-10',
                        'hours'=>'9'
                    ]
                    );
            WorkingDay::create(
                        [
                            'user_id'=>'2',
                            'date'=>'2022-01-10',
                            'hours'=>'10'
                        ]
                        );
            WorkingDay::create(
                            [
                                'user_id'=>'3',
                                'date'=>'2022-01-10',
                                'hours'=>'5'
                            ]
                            );

            WorkingDay::create(
                                [
                                    'user_id'=>'1',
                                    'date'=>'2022-01-09',
                                    'hours'=>'4'
                                ]
                                );
            WorkingDay::create(
                                    [
                                        'user_id'=>'2',
                                        'date'=>'2022-01-09',
                                        'hours'=>'8'
                                    ]
                                    );
            WorkingDay::create(
                                        [
                                            'user_id'=>'3',
                                            'date'=>'2022-01-09',
                                            'hours'=>'10'
                                        ]
                                        );
             WorkingDay::create(
                                        [
                                            'user_id'=>'1',
                                            'date'=>'2022-01-08',
                                            'hours'=>'10'
                                            ]
                                            );
            WorkingDay::create(
                                             [
                                            'user_id'=>'2',
                                             'date'=>'2022-01-08',
                                             'hours'=>'9'
                                             ]
                                             );
            WorkingDay::create(
                                            [
                                            'user_id'=>'3',
                                            'date'=>'2022-01-08',
                                            'hours'=>'9'
                                             ]
                                             );
    }
}
