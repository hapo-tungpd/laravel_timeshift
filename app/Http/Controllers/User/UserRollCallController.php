<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\RollCall;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserRollCallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $createTimeNow = Carbon::now()->toDateString();
        $rollCalls = RollCall::where('user_id', Auth::user()->id)
            ->where('day', $createTimeNow)
            ->first();
        $data = [
            'rollCalls' => $rollCalls,
        ];
        return view("user.roll_call.index", $data);
    }

    public function showAllRollCall()
    {
        $rollCalls = RollCall::where('user_id', Auth::user()->id)
            ->orderby('updated_at', Auth::user()->updated_at)
            ->paginate(config('app.user_report_pagination'));
        $data = [
            'rollCalls' => $rollCalls,
        ];
        return view("user.roll_call.show_all", $data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rollCall = new RollCall();
        $rollCall->user_id = Auth::user()->id;
        $rollCall->day = Carbon::now()->format('Y-m-d');
        $rollCall->start_time = Carbon::now()->toDateTimeString();
        $rollCall->end_time = Carbon::now()->toDateTimeString();
        $toTime = strtotime($rollCall->end_time);
        $fromTime = strtotime($rollCall->start_time);
        $hour = round(($toTime - $fromTime)/(60*60), 2);
        $rollCall->total_time = $hour;
        $dateTime = RollCall::where('user_id', Auth::user()->id)->orderBy('start_time', 'desc')->value('start_time');
        $dateTimeDay = substr($dateTime, 0, 10);
        $date = substr($rollCall->start_time, 0, 10);
        if (!($date === $dateTimeDay)) {
            $rollCall->save();
            return redirect()->route('roll-call.index');
        } else {
            return redirect()->route('roll-call.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $request = RollCall::findOrFail($id);
        $data = [
            'rollCall' => $request,
        ];
        return view('user.roll_call.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $timeNow = Carbon::now();
        $timeMorning = $timeNow->hour(8)->minute(30)->second(0)->toDateTimeString();
        $timeAfternoon = $timeNow->hour(18)->minute(0)->second(0)->toDateTimeString();
        $request = RollCall::findOrFail($id);
        $request->end_time = Carbon::now()->toDateTimeString();
        $timeStartWorking = $request->start_time;
        $timeEndWorking = $request->end_time;
        if (($timeStartWorking >= $timeMorning) && ($timeEndWorking <= $timeAfternoon)) {
            $toTime = strtotime($request->end_time);
            $fromTime = strtotime($request->start_time);
            $hour = round(($toTime - $fromTime)/(60*60), 2);
            $request->total_time = $hour;
        } elseif (($timeStartWorking < $timeMorning) && ($timeEndWorking < $timeAfternoon)) {
            $toTime = strtotime($request->end_time);
            $fromTime = strtotime($timeMorning);
            $hour = round(($toTime - $fromTime)/(60*60), 2);
            $request->total_time = $hour;
        } elseif (($timeStartWorking < $timeMorning) && ($timeEndWorking > $timeAfternoon)) {
            $toTime = strtotime($timeAfternoon);
            $fromTime = strtotime($timeMorning);
            $hour = round(($toTime - $fromTime)/(60*60), 2);
            $request->total_time = $hour;
        } elseif (($timeStartWorking > $timeMorning) && ($timeEndWorking > $timeAfternoon)) {
            $toTime = strtotime($timeAfternoon);
            $fromTime = strtotime($request->start_time);
            $hour = round(($toTime - $fromTime)/(60*60), 2);
            $request->total_time = $hour;
        } else {
            $request->total_time = 0;
        }
        $data = [
            'user_id' => $request->user_id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'day' => $request->day,
            'total_time' => $request->total_time,
        ];
        $date_time = RollCall::where('user_id', Auth::user()->id)->orderBy('start_time', 'desc')->value('start_time');
        $date_time_day = substr($date_time, 0, 10);
        $date = substr($request->start_time, 0, 10);
        if ($date === $date_time_day) {
            RollCall::where('id', $id)->update($data);
            return redirect()->route('roll-call.index');
        }
        return redirect()->route('roll-call.index');
    }

    public function statistic()
    {
        $dateTimeMonth = Carbon::now()->format('Y-m');
        $dateTime = RollCall::where('user_id', Auth::user()->id)->orderBy('day', 'desc')->value('day')->format('Y-m');
        $dateTimeDay = substr($dateTime, 0, 7);
        $sumRollCall = RollCall::where('user_id', Auth::user()->id)->where('day', "LIKE", "%" . $dateTimeDay . "%")
            ->sum('total_time');
        $rollcall = RollCall::where('user_id', Auth::user()->id)->where('day', "LIKE", "%" . $dateTimeDay . "%")
            ->paginate(config('app.pagination'));
        $data = [
            'dateTimeMonth' => $dateTimeMonth,
            'rollCalls' => $rollcall,
            'sumRollCall' => $sumRollCall,
        ];
        return view('user.roll_call.statistic', $data);
    }

    public function search(Request $request)
    {
        $fromTime = $request->from_date;
        $toTime = $request->to_date;
        $employees = RollCall::whereBetween('day', [$fromTime, $toTime])
            ->where('user_id', Auth::user()->id)
            ->orderby('updated_at', Auth::user()->updated_at)
            ->paginate(10);
        $sumTime = RollCall::whereBetween('day', [$fromTime, $toTime])->sum('total_time');
        return view('user.roll_call.search', compact('employees', 'sumTime'));
    }

    public function selectStatistic(Request $request)
    {
        $dateTimeMonth = $request->input('month');
        $overtimeMonth = RollCall::where('user_id', Auth::user()->id)
            ->where('day', "LIKE", "%" . $dateTimeMonth . "%")
            ->paginate(config('app.pagination'));
        $sumOvertimeMonth = RollCall::where('user_id', Auth::user()->id)
            ->where('day', "LIKE", "%" . $dateTimeMonth . "%")
            ->sum('total_time');
        $data = [
            'dateTimeMonth' => $dateTimeMonth,
            'overtimeMonths' => $overtimeMonth,
            'sumOvertimeMonth' => $sumOvertimeMonth,
        ];
        return view('user.roll_call.select_statistic', $data);
    }
}
