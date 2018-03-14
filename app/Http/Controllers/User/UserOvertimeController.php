<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Overtime;
use Auth;
use App\Http\Requests\OvertimeUserRequest;

class UserOvertimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $overtime = Overtime::where('user_id', Auth::user()->id)
            ->orderby('updated_at', Auth::user()->updated_at)
            ->paginate(config('app.user_report_pagination'));
        $data = [
            'overtime' => $overtime,
        ];
        return view("user.overtime.index", $data);
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
        $toTime = strtotime($data['start_time']);
        $fromTime = strtotime($data['end_time']);
        $data['total_time'] = ($fromTime - $toTime)/(60*60);
        $data['total_time'] = number_format($data['total_time'], 1, '.', ',');
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
    public function update(OvertimeUserRequest $request, $id)
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
        return response()->json([
            'message' => 'Delete success'
        ]);
    }

    public function search(Request $request)
    {
        $from_time = $request->from_date;
        $to_time = $request->to_date;
        $employees = Overtime::whereBetween('day', [$from_time, $to_time])->paginate(10);
        $sum_time = Overtime::whereBetween('day', [$from_time, $to_time])->sum('total_time');
        return view('user.overtime.search', compact('employees', 'sum_time'));
    }

    public function statistic()
    {
        $dateTime = Overtime::where('user_id', Auth::user()->id)->orderBy('day', 'desc')->value('day');
        $dateTimeDay = $dateTime->format('Y-m');
        $sumOvertime = Overtime::where('user_id', Auth::user()->id)->where('day', "LIKE", "%" . $dateTimeDay . "%")
            ->sum('total_time');
        $overtime = Overtime::where('user_id', Auth::user()->id)->where('day', "LIKE", "%" . $dateTimeDay . "%")
            ->paginate(config('app.pagination'));
        return view("user.overtime.statistic", ['overtime' => $overtime, 'sumOvertime' => $sumOvertime]);
    }
}
