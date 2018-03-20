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
        $timeNow = Carbon::now();
        $timeMorning = $timeNow->hour(8)->minute(30)->second(0)->toDateTimeString();
        $timeAfternoon = $timeNow->hour(18)->minute(0)->second(0)->toDateTimeString();
        $request = RollCall::findOrFail($id);
        $request->end_time = Carbon::now()->toDateTimeString();
        $timeStartWorking = $request->start_time->toDateTimeString();
        $timeEndWorking = $request->end_time;
        if (($timeStartWorking >= $timeMorning) && ($timeEndWorking <= $timeAfternoon)) {
            $toTime = strtotime($request->end_time);
            $fromTime = strtotime($request->start_time);
        } elseif (($timeStartWorking < $timeMorning) && ($timeEndWorking < $timeAfternoon)) {
            $toTime = strtotime($request->end_time);
            $fromTime = strtotime($timeMorning);
        } elseif (($timeStartWorking < $timeMorning) && ($timeEndWorking > $timeAfternoon)) {
            $toTime = strtotime($timeAfternoon);
            $fromTime = strtotime($timeMorning);
        } elseif (($timeStartWorking > $timeMorning) && ($timeEndWorking > $timeAfternoon)) {
            $toTime = strtotime($timeAfternoon);
            $fromTime = strtotime($request->start_time);
        } else {
            $request->total_time = 0;
        }
        $hour = round(($toTime - $fromTime)/(60*60), 2);
        $request->total_time = $hour;
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

    public function statistic(Request $request)
    {

        if ($request->has('month')) {
            $dateTimeMonth = $request->input('month');
            $month =substr($dateTimeMonth, 5, 7);
            $year =substr($dateTimeMonth, 0, 4);
        } else {
            $dateTimeMonth = Carbon::now()->format('Y-m');
        }
        $sumRollCall = RollCall::where('user_id', Auth::user()->id)
            ->whereMonth('day', $month)
            ->whereYear('day', $year)
            ->sum('total_time');
        $rollcall = RollCall::where('user_id', Auth::user()->id)
            ->whereMonth('day', $month)
            ->whereYear('day', $year)
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
}
