<?php

namespace App\Http\Controllers;

use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\OffDay;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{

    function isWeekend($date)
    {
        return (date('N', strtotime($date)) >= 6);
    }


    public function calculate()
    {

        $employees = User::with('workingDays')->get();
        $offDays = OffDay::query()->select('date')->pluck('date')->toArray();

        foreach ($employees as $employee) {
            $name = $employee->full_name;
            $paymant = $employee->total_paga;
            $payforhour = $paymant / 22 / 8;
            $totalPayment = 0;
            $totalPayNormal = 0;
            $daysWorked = $employee->workingDays;
            $weeks = [];
            $months = [];


            $totalNormalHours = 0;
            $totalOvertime = 0;

            foreach ($daysWorked as $day) {

                $normalHours = ($day->hours > 8) ? 8 : $day->hours;
                $overtime = ($day->hours) > 8 ? ($day->hours - 8) : 0;
                $monthKey = Carbon::parse($day->date)->format('Y-m');
                $date = $day->date;
                $weekKey = Carbon::parse($day->date)->weekOfMonth;

                if (!isset($months[$monthKey])) {
                    $months[$monthKey] = [
                        'month' => $monthKey,
                        'normalHours' => 0,
                        'overtime' => 0,
                        'totalHours' => 0,
                        'paynormal' => 0,
                        'totalPayment' => 0,
                        'weeks' => [],
                    ];

                }

                if (!isset($months[$monthKey]['weeks'][$weekKey])) {
                    $months[$monthKey]['weeks'][$weekKey] = [
                        'week' => $weekKey,
                        'normalHours' => 0,
                        'overtime' => 0,
                        'totalHours' => 0,
                        'paynormal' => 0,
                        'totalPayment' => 0,

                    ];
                }
                // Dite festive
                if (in_array($day->date, $offDays)) {
                    $inKoef = 1.5;
                    $outKoef = 2.0;
                } else if (self::isWeekend($day->date)) {
                    $inKoef = 1.25;
                    $outKoef = 1.5;

                } else {
                    $inKoef = 1;
                    $outKoef = 1.25;
                }

                $totalPayment += $normalHours * $payforhour * $inKoef + $overtime * $payforhour * $outKoef;
                $totalPayNormal += $normalHours * $payforhour * $inKoef;

                $totalNormalHours += $normalHours;
                $totalOvertime += $overtime;

                $months[$monthKey]['normalHours'] += $normalHours;
                $months[$monthKey]['overtime'] += $overtime;
                $months[$monthKey]['totalHours'] = $months[$monthKey]['normalHours'] + $months[$monthKey]['overtime'];
                $months[$monthKey]['paynormal'] += $normalHours * $payforhour * $inKoef;
                $months[$monthKey]['totalPayment'] += $normalHours * $payforhour * $inKoef + $overtime * $payforhour * $outKoef;
                // te gjitha property te week
                $months[$monthKey]['weeks'][$weekKey]['normalHours'] += $normalHours;
                $months[$monthKey]['weeks'][$weekKey]['overtime'] += $overtime;
                $months[$monthKey]['weeks'][$weekKey]['totalHours'] = $months[$monthKey]['weeks'][$weekKey]['normalHours'] + $months[$monthKey]['weeks'][$weekKey]['overtime'];
                $months[$monthKey]['weeks'][$weekKey]['paynormal'] += $normalHours * $payforhour * $inKoef;
                $months[$monthKey]['weeks'][$weekKey]['totalPayment'] += $normalHours * $payforhour * $inKoef + $overtime * $payforhour * $outKoef;

            }

            $results[] = [
                'name' => $name,
                'normalHours' => $totalNormalHours,
                'overtime' => $totalOvertime,
                'totalHours' => ($totalNormalHours + $totalOvertime),
                'paynormal' => $totalPayNormal,
                'totalPayment' => $totalPayment,
                'months' => $months,
            ];

        }


//        dd($results);


        return redirect('/');
    }
//$full_name=$employee->full_name;
//$checkins=$employee->checkins;
//$checkinsdate= Checkin::query()->select('check_in_date')->where('user_id',$employee->id)->pluck('check_in_date')->toArray();
//
//$checkin_total=0;
//foreach ($checkinsdate as $checkin){
//
//
//
//
////                $checkinh=$checkin->check_in_hour;
//$checkout=$checkin->check_out_hour;
//$diff = Carbon::now()>diffInSeconds($checkout);
//
//
//
//
//
//dd($diff);
//}


}
