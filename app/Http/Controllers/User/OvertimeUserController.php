<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Overtime;
use Auth;
use App\Http\Requests\OvertimeUserRequest;

class OvertimeUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $overtime = Overtime::where('user_id', Auth::user()->id)->paginate(config('app.pagination'));
        return view("user.overtime.index", ['overtime' => $overtime]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.overtime.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OvertimeUserRequest $request)
    {
        $data = $request->all();
        $data['start_time'] = $data['day'] . ' ' . $data['start_time'] . ':00';
        $data['end_time'] = $data['day'] . ' ' . $data['end_time'] . ':00';
        $to_time = strtotime($data['start_time']);
        $from_time = strtotime($data['end_time']);
        $data['total_time'] = ceil($from_time - $to_time)/(60*60);
        Overtime::create($data);
        return redirect()->route('overtime.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $overtime = Overtime::findOrFail($id);
        $data = [
            'overtime' => $overtime,
        ];
        return view('user.overtime.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $overtime = Overtime::findOrFail($id);
        $data = [
            'overtime' => $overtime,
        ];
        return view('user.overtime.edit', $data);
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
        $data = $request->all();
        $data = array_slice($data, 2);
        $data['start_time'] = $data['day'] . ' ' . $data['start_time'] . ':00';
        $data['end_time'] = $data['day'] . ' ' . $data['end_time'] . ':00';
        Overtime::where('id', $id)->update($data);
        return redirect()->route('overtime.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Overtime::findOrFail($id)->delete();
        return redirect()->route('overtime.index');
    }

    public function statistic()
    {
        $dateTime = Overtime::where('user_id', Auth::user()->id)->orderBy('day', 'desc')->value('day');
        $date_time_day = substr($dateTime, 0, 7);
        $sum_overtime = Overtime::where('user_id', Auth::user()->id)->where('day', "LIKE", "%" . $date_time_day . "%")
            ->sum('total_time');
        $overtime = Overtime::where('user_id', Auth::user()->id)->where('day', "LIKE", "%" . $date_time_day . "%")
            ->paginate(config('app.pagination'));
        return view("user.overtime.statistic", ['overtime' => $overtime, 'sum_overtime' => $sum_overtime]);
    }
}
