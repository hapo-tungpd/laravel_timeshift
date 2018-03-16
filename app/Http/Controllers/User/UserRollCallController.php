<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\RollCall;
use App\Models\User;
use Carbon\Carbon;

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
        $rollcall = RollCall::where('user_id', Auth::user()->id)
            ->where('day', $createTimeNow)
            ->paginate(config('app.user_report_pagination'));
        $data = [
            'rollcall' => $rollcall,
        ];
        return view("user.roll_call.index", $data);
    }

    public function showAllRollCall()
    {
        $rollcall = RollCall::where('user_id', Auth::user()->id)
            ->orderby('updated_at', Auth::user()->updated_at)
            ->paginate(config('app.user_report_pagination'));
        $data = [
            'rollcall' => $rollcall,
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
        $rollcall = new RollCall();
        $rollcall->user_id = Auth::user()->id;
        $rollcall->day = Carbon::now()->format('Y-m-d');
        $rollcall->start_time = Carbon::now()->toDateTimeString();
        $rollcall->end_time = Carbon::now()->toDateTimeString();
        $toTime = strtotime($rollcall->end_time);
        $fromTime = strtotime($rollcall->start_time);
        $hour = round(($toTime - $fromTime)/(60*60), 2);
        $rollcall->total_time = $hour;
        $dateTime = RollCall::where('user_id', Auth::user()->id)->orderBy('start_time', 'desc')->value('start_time');
        $dateTimeDay = substr($dateTime, 0, 10);
        $date = substr($rollcall->start_time, 0, 10);
        if (!($date === $dateTimeDay)) {
            $rollcall->save();
            return redirect()->route('rollcall.index');
        } else {
            return redirect()->route('rollcall.index');
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
            'rollcall' => $request,
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
        } elseif (($timeStartWorking < $timeMorning) && ($timeEndWorking <= $timeAfternoon)) {
            $toTime = strtotime($request->end_time);
            $fromTime = strtotime($timeMorning);
            $hour = round(($toTime - $fromTime)/(60*60), 2);
            $request->total_time = $hour;
        } elseif (($timeStartWorking < $timeMorning) && ($timeEndWorking > $timeAfternoon)) {
            $toTime = strtotime($timeAfternoon);
            $fromTime = strtotime($timeMorning);
            $hour = round(($toTime - $fromTime)/(60*60), 2);
            $request->total_time = $hour;
        } else {
            $toTime = strtotime($timeAfternoon);
            $fromTime = strtotime($request->start_time);
            $hour = round(($toTime - $fromTime)/(60*60), 2);
            $request->total_time = $hour;
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
            return redirect()->route('rollcall.index');
        }
        return redirect()->route('rollcall.index');
    }

    public function statistic()
    {
        $dateTime = RollCall::where('user_id', Auth::user()->id)->orderBy('day', 'desc')->value('day');
        $dateTimeDay = substr($dateTime, 0, 7);
        $sumRollcall = RollCall::where('user_id', Auth::user()->id)->where('day', "LIKE", "%" . $dateTimeDay . "%")
            ->sum('total_time');
        $rollcall = RollCall::where('user_id', Auth::user()->id)->where('day', "LIKE", "%" . $dateTimeDay . "%")
            ->paginate(config('app.pagination'));
        return view('user.roll_call.statistic', ['rollcall' => $rollcall, 'sumRollcall' => $sumRollcall]);
    }

    public function search(Request $request)
    {
        $fromTime = $request->from_date;
        $toTime = $request->to_date;
        $employees = RollCall::whereBetween('day', [$fromTime, $toTime])
            ->where('user_id', Auth::user()->id)
            ->paginate(10);
        $sumTime = RollCall::whereBetween('day', [$fromTime, $toTime])->sum('total_time');
        return view('user.roll_call.search', compact('employees', 'sumTime'));
    }
}
