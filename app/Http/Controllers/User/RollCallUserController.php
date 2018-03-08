<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\RollCall;

class RollCallUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rollcall = RollCall::where('user_id', Auth::user()->id)->paginate(config('app.pagination'));
        return view("user.roll_call.index", ['rollcall' => $rollcall]);
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
        $rollcall->day = date('Y-m-d');
        $rollcall->start_time = date('Y-m-d H:i:s');
        $rollcall->end_time = date('Y-m-d H:i:s');
        //hour OT
        $to_time = strtotime($rollcall->end_time);
        $from_time = strtotime($rollcall->start_time);
        $hour = ceil($to_time - $from_time)/(60*60);
        $rollcall->total_time = $hour;
        $date_time = RollCall::where('user_id', Auth::user()->id)->orderBy('start_time', 'desc')->value('start_time');
        $date_time_day = substr($date_time, 0, 10);
        $date = substr($rollcall->start_time, 0, 10);
        if (!($date === $date_time_day)) {
            $rollcall->save();
            return redirect()->route('rollcall.index');
        } else {
            return redirect()->route('rollcall.index');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $request = RollCall::findOrFail($id);
        $request->end_time = date('Y-m-d H:i:s');
        $to_time = strtotime($request->end_time);
        $from_time = strtotime($request->start_time);
        $hour = ceil($to_time - $from_time)/(60*60);
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
            return redirect()->route('rollcall.index');
        }
        return redirect()->route('rollcall.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function statistic()
    {
        $date_time = RollCall::where('user_id', Auth::user()->id)->orderBy('day', 'desc')->value('day');
        $date_time_day = substr($date_time, 0, 7);
        $sum_rollcall = RollCall::where('user_id', Auth::user()->id)->where('day', "LIKE", "%" . $date_time_day . "%")
            ->sum('total_time');
        $rollcall = RollCall::where('user_id', Auth::user()->id)->where('day', "LIKE", "%" . $date_time_day . "%")
            ->paginate(config('app.pagination'));
        return view('user.roll_call.statistic', ['rollcall' => $rollcall, 'sum_rollcall' => $sum_rollcall]);
    }
}
