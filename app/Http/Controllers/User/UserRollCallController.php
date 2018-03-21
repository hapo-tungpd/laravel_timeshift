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
        $createTimeNow = Carbon::now();
        $rollCallToDay = RollCall::where('user_id', Auth::user()->id)
            ->whereDay('day', $createTimeNow->format('d'))
            ->first();
        $rollCalls = RollCall::where('user_id', Auth::user()->id)
            ->orderby('updated_at', 'DESC')
            ->skip(1)->take(10)->get();
        $data = [
            'rollCallToDay' => $rollCallToDay,
            'rollCalls' => $rollCalls,
        ];
        return view("user.roll_call.index", $data);
}

    public function userRollCall()
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
        if ($date !== $dateTimeDay) {
            $rollCall->save();
            return redirect()->route('roll-call.index');
        } else {
            return redirect()->route('roll-call.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //administrative time
        $timeMorning = Carbon::createFromTime(8, 0, 0);
        $timeAfternoon = Carbon::createFromTime(17, 30, 0);

        $startHiru = Carbon::createFromTime(12, 0, 0);
        $endHiru = Carbon::createFromTime(13, 30, 0);

        $rollCall = RollCall::findOrFail($id);
        $rollCall->end_time = Carbon::now();

        $timeStartWorking = $rollCall->start_time;
        $timeEndWorking = $rollCall->end_time;

        $toTime = 0;
        $fromTime = 0;
        if (($timeStartWorking >= $timeMorning) && ($timeEndWorking <= $timeAfternoon)) {
            $toTime = $rollCall->end_time;
            $fromTime = ($rollCall->start_time);
        } elseif (($timeStartWorking < $timeMorning) && ($timeEndWorking < $timeAfternoon)) {
            $toTime = $rollCall->end_time;
            $fromTime = $timeMorning;
        } elseif (($timeStartWorking < $timeMorning) && ($timeEndWorking > $timeAfternoon)) {
            $toTime = ($timeAfternoon);
            $fromTime = $timeMorning;
        } elseif (($timeStartWorking > $timeMorning) && ($timeEndWorking > $timeAfternoon)) {
            $toTime = $timeAfternoon;
            $fromTime = $rollCall->start_time;
        } else {
            $rollCall->total_time = 0;
        }
        if (($toTime >= $startHiru) && ($toTime <= $endHiru)) {
            $hour = round(($fromTime->diffInMinutes($startHiru))/60, 2);
        } elseif ($toTime > $endHiru) {
            $hour = round(($fromTime->diffInMinutes($startHiru))/60, 2)
                + round(($endHiru->diffInMinutes($toTime))/60, 2);
        } elseif ($toTime < $startHiru) {
            $hour = round($fromTime->diffInMinutes($toTime)/60, 2);
        }
        $rollCall->total_time = $hour;
        $data = [
            'user_id' => $rollCall->user_id,
            'start_time' => $rollCall->start_time,
            'end_time' => $rollCall->end_time,
            'day' => $rollCall->day,
            'total_time' => $rollCall->total_time,
        ];
        RollCall::where('id', $id)->update($data);
        return redirect()->route('roll-call.index');
    }

    public function statistic(Request $request)
    {
        if ($request->has('month')) {
            $dateTimeMonth = $request->input('month');
        } else {
            $dateTimeMonth = Carbon::now()->format('Y-m');
        }
        $month =substr($dateTimeMonth, 5, 7);
        $year =substr($dateTimeMonth, 0, 4);
        $sumRollCall = RollCall::where('user_id', Auth::user()->id)
            ->whereMonth('day', $month)
            ->whereYear('day', $year)
            ->sum('total_time');
        $rollCall = RollCall::where('user_id', Auth::user()->id)
            ->whereMonth('day', $month)
            ->whereYear('day', $year)
            ->orderBy('day', 'DESC')
            ->paginate(config('app.pagination'));
        $data = [
            'dateTimeMonth' => $dateTimeMonth,
            'rollCalls' => $rollCall,
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
}
