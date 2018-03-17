<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Overtime;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class OvertimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $overTime = Overtime::orderBy('updated_at', 'desc')->paginate(config('app.user_pagination'));
        $data = [
            'overTime' => $overTime,
        ];
        return view('admin.overtime.index', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $overTime = Overtime::findOrFail($id);
        $user = User::findOrFail($overTime->user_id);
        $data = [
            'overTime' => $overTime,
            'user' => $user,
        ];
        return view('admin.overtime.show', $data);
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
        $overTime = Overtime::orderBy('updated_at', 'desc')->paginate(config('app.user_pagination'));
        $date = Carbon::now();
        $dateTimeDay = substr($date, 0, 10);
        $sumOverTimeToday = Overtime::where('day', "LIKE", "%" . $dateTimeDay . "%")
            ->sum('total_time');
        $overTimeDay = Overtime::where('day', "LIKE", "%" . $dateTimeDay . "%")
            ->paginate(config('app.pagination'));
        $dateTimeMonth = substr($date, 0, 7);
        $sumOverTimeMonth = Overtime::where('day', "LIKE", "%" . $dateTimeMonth . "%")
            ->sum('total_time');
        $overTimeMonth = Overtime::where('day', "LIKE", "%" . $dateTimeMonth . "%")
            ->paginate(config('app.pagination'));
        $dataName = Overtime::where('day', "LIKE", "%" . $dateTimeDay . "%")
            ->select('user_id', DB::raw('SUM(total_time) as total_times'))
            ->groupBy('user_id')
            ->paginate(config('app.pagination'));
        $dataSumRollCallToDay = Overtime::where('day', "LIKE", "%" . $dateTimeDay . "%")
            ->sum('total_time');
        $dataNameMonth = Overtime::where('day', "LIKE", "%" . $dateTimeMonth . "%")
            ->select('user_id', DB::raw('SUM(total_time) as total_times'))
            ->groupBy('user_id')
            ->paginate(config('app.pagination'));
        $dataSumRollCallMonth = Overtime::where('day', "LIKE", "%" . $dateTimeMonth . "%")
            ->sum('total_time');
        $data = [
            'overTimeDay' => $overTimeDay,
            'sumOverTimeToday' => $sumOverTimeToday,
            'overTimeMonth' => $overTimeMonth,
            'sumOverTimeMonth' => $sumOverTimeMonth,
            'overTime' => $overTime,
            'dataName' => $dataName,
            'dataSumRollCallToDay' => $dataSumRollCallToDay,
            'dataNameMonth' => $dataNameMonth,
            'dataSumRollCallMonth' => $dataSumRollCallMonth,
            'dateTimeMonth' => $dateTimeMonth,
        ];
        return view('admin.overtime.statistic', $data);
    }

    public function search(Request $request)
    {

        $fromTime = $request->from_date;
        $toTime = $request->to_date;

        $employees = Overtime::whereBetween('day', [$fromTime, $toTime])->paginate(10);
        $sumTime = Overtime::whereBetween('day', [$fromTime, $toTime])->sum('total_time');
        $data = [
            'employees' => $employees,
            'sumTime' => $sumTime,
        ];
        return view('admin.overtime.search', $data);
    }

    public function showOvertime($user_id)
    {
        $overTimeEmployee = Overtime::where('user_id', $user_id)
            ->whereMonth('day', Carbon::now()->format('m'))
            ->whereYear('day', Carbon::now()->format('Y'))
            ->paginate(config('app.pagination'));
        $data = [
            'overTimeEmployee' => $overTimeEmployee,
        ];
        return view('admin.overtime.show-overtime', $data);
    }

    public function selectStatistic(Request $request)
    {
        $dateTimeMonth = $request->input('month'); //2018-02
        //total time roll call of month
        $sumOvertimeMonth = Overtime::where('day', "LIKE", "%" . $dateTimeMonth . "%")
            ->sum('total_time');
        //get user roll call of month
        $overtimeMonth = Overtime::where('day', "LIKE", "%" . $dateTimeMonth . "%")
            ->paginate(config('app.pagination'));
        $dataNameMonth = Overtime::where('day', "LIKE", "%" . $dateTimeMonth . "%")
            ->select('user_id', DB::raw('SUM(total_time) as total_times'))
            ->groupBy('user_id')
            ->paginate(config('app.pagination'));
        $dataSumOvertimeMonth = Overtime::where('day', "LIKE", "%" . $dateTimeMonth . "%")
            ->sum('total_time');
        $data = [
            'dateTimeMonth' => $dateTimeMonth,
            'sumOvertimeMonth' => $sumOvertimeMonth,
            'overtimeMonth' => $overtimeMonth,
            'dataNameMonth' => $dataNameMonth,
            'dataSumOvertimeMonth' => $dataSumOvertimeMonth,
        ];
        return view('admin.overtime.select_statistic', $data);
    }
}
