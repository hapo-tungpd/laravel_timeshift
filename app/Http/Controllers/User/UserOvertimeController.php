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

    public function search(Request $request)
    {
        $fromTime = $request->from_date;
        $toTime = $request->to_date;
        $employees = Overtime::whereBetween('day', [$fromTime, $toTime])
            ->where('user_id', Auth::user()->id)
            ->paginate(config('app.user_pagination'));
        $sumTime = Overtime::whereBetween('day', [$fromTime, $toTime])->sum('total_time');
        return view('user.overtime.search', compact('employees', 'sumTime'));
    }

    public function statistic()
    {
        $date = Carbon::now();
        $dateTimeMonth = substr($date, 0, 7);
//        $dateTime = Overtime::where('user_id', Auth::user()->id)->orderBy('day', 'desc')->value('day');
//        $dateTimeDay = $dateTime->format('Y-m');
        $sumOvertime = Overtime::where('user_id', Auth::user()->id)->where('day', "LIKE", "%" . $dateTimeMonth . "%")
            ->sum('total_time');
        $sumDayMonth = Overtime::where('user_id', Auth::user()->id)->where('day', "LIKE", "%" . $dateTimeMonth . "%")
//            ->select('name', 'day as days')
//            ->groupBy('day')
            ->count('day');
        $overtime = Overtime::where('user_id', Auth::user()->id)->where('day', "LIKE", "%" . $dateTimeMonth . "%")
            ->paginate(config('app.pagination'));
//        dd($sumDayMonth);
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
        $overtimeMonth = Overtime::where('user_id', Auth::user()->id)
            ->where('day', "LIKE", "%" . $dateTimeMonth . "%")
            ->paginate(config('app.pagination'));
        $sumOvertimeMonth = Overtime::where('user_id', Auth::user()->id)
            ->where('day', "LIKE", "%" . $dateTimeMonth . "%")
            ->sum('total_time');
        $dataNameMonth = Overtime::where('user_id', Auth::user()->id)
            ->where('day', "LIKE", "%" . $dateTimeMonth . "%")
            ->select('day', DB::raw('SUM(total_time) as total_times'))
            ->groupBy('day')
            ->paginate(config('app.pagination'));
        $dataSumOvertimeMonth = Overtime::where('user_id', Auth::user()->id)
            ->where('day', "LIKE", "%" . $dateTimeMonth . "%")
            ->sum('total_time');
        $data = [
            'dateTimeMonth' => $dateTimeMonth,
            'overtimeMonth' => $overtimeMonth,
            'sumOvertimeMonth' => $sumOvertimeMonth,
            'dataNameMonth' => $dataNameMonth,
            'dataSumOvertimeMonth' => $dataSumOvertimeMonth,
        ];
        return view('user.overtime.select_statistic', $data);
    }
}
