<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Overtime;
use Auth;
use App\Http\Requests\OvertimeUserRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserOvertimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (($request->has('from_date')) && ($request->has('to_date'))) {
            $fromTime = $request->from_date;
            $toTime = $request->to_date;
            $overtime = Overtime::whereBetween('day', [$fromTime, $toTime])
                ->where('user_id', Auth::user()->id)
                ->paginate(config('app.user_pagination'));
        }
        if ($request->has('from_date')) {
            $fromTime = $request->from_date;
            $overtime = Overtime::whereDate('day', $fromTime)
                ->where('user_id', Auth::user()->id)
                ->paginate(config('app.user_pagination'));
        } else {
            $overtime = Overtime::where('user_id', Auth::user()->id)
                ->orderby('updated_at', 'DESC')
                ->paginate(config('app.user_report_pagination'));
        }
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
        $data['total_time'] = round(($fromTime - $toTime)/(60*60), 2);
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
        $toTime = strtotime($data['start_time']);
        $fromTime = strtotime($data['end_time']);
        $data['total_time'] = round(($fromTime - $toTime)/(60*60), 2);
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

    public function statistic()
    {
        $dateTimeMonth = Carbon::now()->format('Y-m');
        $sumOvertime = Overtime::where('user_id', Auth::user()->id)
            ->whereMonth('day', Carbon::now()->format('m'))
            ->whereYear('day', Carbon::now()->format('Y'))
            ->sum('total_time');
        $sumDayMonth = Overtime::where('user_id', Auth::user()->id)
            ->whereMonth('day', Carbon::now()->format('m'))
            ->whereYear('day', Carbon::now()->format('Y'))
            ->count('day');
        $overtime = Overtime::where('user_id', Auth::user()->id)
            ->whereMonth('day', Carbon::now()->format('m'))
            ->whereYear('day', Carbon::now()->format('Y'))
            ->orderBy('day', 'DESC')
            ->paginate(config('app.pagination'));
        $data = [
            'overtime' => $overtime,
            'sumOvertime' => $sumOvertime,
            'dateTimeMonth' => $dateTimeMonth,
            'sumDayMonth' => $sumDayMonth,
        ];
        return view("user.overtime.statistic", $data);
    }

    public function selectStatistic(Request $request)
    {
        $dateTimeMonth = $request->input('month');
        $month =substr($dateTimeMonth, 5, 7);
        $year =substr($dateTimeMonth, 0, 4);
        $overtimeMonth = Overtime::where('user_id', Auth::user()->id)
            ->whereMonth('day', $month)
            ->whereYear('day', $year)
            ->paginate(config('app.pagination'));
        $sumOvertimeMonth = Overtime::where('user_id', Auth::user()->id)
            ->whereMonth('day', $month)
            ->whereYear('day', $year)
            ->sum('total_time');
        $dataNameMonth = Overtime::where('user_id', Auth::user()->id)
            ->whereMonth('day', $month)
            ->whereYear('day', $year)
            ->select('day', DB::raw('SUM(total_time) as total_times'))
            ->groupBy('day')
            ->paginate(config('app.pagination'));
        $data = [
            'dateTimeMonth' => $dateTimeMonth,
            'overtimeMonth' => $overtimeMonth,
            'sumOvertimeMonth' => $sumOvertimeMonth,
            'dataNameMonth' => $dataNameMonth,
        ];
        return view('user.overtime.select_statistic', $data);
    }
}
