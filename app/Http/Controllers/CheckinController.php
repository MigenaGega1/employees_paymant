<?php

namespace App\Http\Controllers;

use App\Models\Checkin;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

//use Yajra\DataTables\Facades\DataTables;

class CheckinController extends Controller
{
    public function calculate(Request $request)
    {
        $users = User::all();
        $results = [];
        $query = Checkin::query()->with('user');
        if ($request->filled('date')) {
            $date_input = Carbon::parse($request->input('date'))->format('Y:m:d');
            $query->where('check_in_date', '=', $date_input);
        }
        if ($request->filled('user_id')) {
            $user_id = $request->user_id;
            $query->where('user_id', '=', $user_id);
        }
        $dates = $query->get();
        foreach ($dates as $date) {
            $key = $date->user->id . '-' . $date->check_in_date;
            if ($date->check_out_hour == '00:00:00') {
                $default = '18:00:00';
                $check_out = CarbonInterval::createFromFormat('H:i:s', $default)->totalSeconds;
            } else {
                $check_out = CarbonInterval::createFromFormat('H:i:s', $date->check_out_hour)->totalSeconds;
            }
            $check_in = CarbonInterval::createFromFormat('H:i:s', $date->check_in_hour)->totalSeconds;
            $total_check_in = $check_out - $check_in;
            if (!isset($results[$key])) {
                $results[$key] = [
                    'key' => $key,
                    'user_id' => $date->user->id,
                    'full_name' => $date->user->full_name,
                    'date' => $date->check_in_date,
                    'check_in' => 0,
                    'check_out' => 0,
                    'total_check_in' => 0,
                ];
            }

            $results[$key]['check_in'] = $check_in;
            $results[$key]['check_out'] = $check_out;
            $results[$key]['total_check_in'] = Carbon::parse($results[$key]['total_check_in'])->addSeconds($total_check_in)->format('H:i:s');

        }
//        dd($results);
        return view('payment', ['results' => $results], ['users' => $users]);
    }


    public function getUsersWithCheckins(Request $request)
    {
        if (request()->ajax()) {
            $query = User::query()->with(['checkins' => function ($query) use ($request) {

                if ($request->filled('from_date') && $request->filled('to_date')) {
                    $from_date = $request->input('from_date', now()->startOfYear()->format('Y-m-d'));
                    $to_date = $request->input('to_date', now()->endOfYear()->format('Y-m-d'));
                    $query->whereBetween('check_in_date', array($from_date, $to_date));
                }
                if ($request->filled('date')) {
                    $query->whereDate('check_in_date', $request->operatorDate, Carbon::parse($request->input('date'))->format('Y:m:d'));
                }
                if ($request->filled('name')) {
                    $query->leftJoin('users', 'checkins.user_id', '=', 'users.id');
                    $query->where('full_name', $request->operatorName, $request->name);
                }
                if ($request->filled('id')) {
                    $query->leftJoin('users', 'checkins.user_id', '=', 'users.id');
                    $query->where('users.id', $request->operatorId, $request->id);
                }


            }])->get();

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('total_in',
                    function ($user) {
                        $checkins = $user->checkins;
                        $total_in = 0;
                        foreach ($checkins as $checkin) {
                            $check_in = CarbonInterval::createFromFormat('H:i:s', $checkin->check_in_hour)->totalSeconds;
                            $check_out = ($checkin->check_out_hour == '00:00:00') ? CarbonInterval::createFromFormat('H:i:s', '18:00:00')->totalSeconds : CarbonInterval::createFromFormat('H:i:s', $checkin->check_out_hour)->totalSeconds;
                            $total_in += $check_out - $check_in;
                        }
                        return $total_in;
                    })->make(true);
        }
        return view('payment');
    }

//    function convert($ss) {
//        $s = $ss%60;
//        $m = floor(($ss%3600)/60);
//        $h = floor($ss/60);
//        return "$h:$m:$s";
//    }

}










