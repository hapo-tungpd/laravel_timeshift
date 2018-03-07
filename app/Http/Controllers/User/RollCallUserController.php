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
        $rollcall->start_time = date('Y-m-d H:i:s');
        $rollcall->user_id = Auth::user()->id;
        $date_time = RollCall::where('user_id', Auth::user()->id)->orderBy('start_time', 'desc')->value('start_time');
        $date_time_day = substr($date_time, 0, 10);
        $date = substr($rollcall->start_time,0,10);
        if (!($date === $date_time_day)) {
            $rollcall->save();
            return redirect()->route('rollcall.index');
        }
        else
        return redirect()->route('rollcall.index');
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
        //
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
}
