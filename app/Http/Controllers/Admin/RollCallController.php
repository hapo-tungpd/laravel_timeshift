<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\RollCall;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RollCallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rollCall = RollCall::orderBy('updated_at', 'desc')->paginate(config('app.user_pagination'));
        $data = [
            'rollCall' => $rollCall,
        ];
        return view('admin.roll-call.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $rollCall = RollCall::findOrFail($id);
        $user = User::findOrFail($rollCall->user_id);
        $data = [
            'rollCall' => $rollCall,
            'user' => $user,
        ];
        return view('admin.roll-call.show', $data);
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
        RollCall::findOrFail($id)->delete();
        return response()->json([
            'message' => 'Delete success'
        ]);
    }

    public function search(Request $request)
    {
        $fromTime = $request->from_date;
        $toTime = $request->to_date;
        $employees = RollCall::whereBetween('day', [$fromTime, $toTime])
            ->paginate(config('app.user_pagination'));
        $sumTime = RollCall::whereBetween('day', [$fromTime, $toTime])->sum('total_time');
        return view('admin.roll-call.search', compact('employees', 'sumTime'));
    }

    public function statistic()
    {
        $rollCall = RollCall::orderBy('updated_at', 'desc')->paginate(config('app.user_pagination'));
        //get time right now
        $date = Carbon::now();
        //get day right now d-m-Y
        $dateTimeDay = substr($date, 0, 10);
        //total time roll call today
        $sumRollCallToday = RollCall::where('day', "LIKE", "%" . $dateTimeDay . "%")
            ->sum('total_time');
        //get user roll call today
        $rollCallDay = RollCall::where('day', "LIKE", "%" . $dateTimeDay . "%")
            ->paginate(config('app.pagination'));
        //get month right now m-Y
        $dateTimeMonth = substr($date, 0, 7); //2018-03
        //total time roll call of month
        $sumRollCallMonth = RollCall::where('day', "LIKE", "%" . $dateTimeMonth . "%")
            ->sum('total_time');
        //get user roll call of month
        $rolCallMonth = RollCall::where('day', "LIKE", "%" . $dateTimeMonth . "%")
            ->paginate(config('app.pagination'));
        $dataName = RollCall::where('day', "LIKE", "%" . $dateTimeDay . "%")
            ->select('user_id', DB::raw('SUM(total_time) as total_times'))
            ->groupBy('user_id')
            ->paginate(config('app.pagination'));
        $dataSumRollCallToDay = RollCall::where('day', "LIKE", "%" . $dateTimeDay . "%")
            ->sum('total_time');
        $dataNameMonth = RollCall::where('day', "LIKE", "%" . $dateTimeMonth . "%")
            ->select('user_id', DB::raw('SUM(total_time) as total_times'))
            ->groupBy('user_id')
            ->paginate(config('app.pagination'));
        $dataSumRollCallMonth = RollCall::where('day', "LIKE", "%" . $dateTimeMonth . "%")
            ->sum('total_time');
        $data = [
            'dateTimeMonth' => $dateTimeMonth,
            'rollCallDay' => $rollCallDay,
            'sumRollCallToday' => $sumRollCallToday,
            'rolCallMonth' => $rolCallMonth,
            'sumRollCallMonth' => $sumRollCallMonth,
            'rollCall' => $rollCall,
            'dataName' => $dataName,
            'dataSumRollCallToDay' => $dataSumRollCallToDay,
            'dataNameMonth' => $dataNameMonth,
            'dataSumRollCallMonth' => $dataSumRollCallMonth,
        ];
        return view('admin.roll-call.statistic', $data);
    }

    public function showRollCall($user_id)
    {
        $rollCallEmployee = RollCall::where('user_id', $user_id)
            ->whereMonth('day', Carbon::now()->format('m'))
            ->whereYear('day', Carbon::now()->format('Y'))
            ->paginate(config('app.pagination'));

        $countRollCall = RollCall::where('user_id', $user_id)
            ->whereMonth('day', Carbon::now()->format('m'))
            ->whereYear('day', Carbon::now()->format('Y'))
            ->distinct('day')->count('day');
        $dataSumRollCallMonth = RollCall::where('user_id', $user_id)
            ->whereMonth('day', Carbon::now()->format('m'))
            ->whereYear('day', Carbon::now()->format('Y'))
            ->sum('total_time');
        $data = [
            'dataSumRollCallMonth' => $dataSumRollCallMonth,
            'countRollCall' => $countRollCall,
            'rollCallEmployee' => $rollCallEmployee,
        ];
        return view('admin.roll-call.show-roll-call', $data);
    }

    public function selectStatistic(Request $request)
    {
        $dateTimeMonth = $request->input('month'); //2018-02
        //total time roll call of month
        $sumRollCallMonth = RollCall::where('day', "LIKE", "%" . $dateTimeMonth . "%")
            ->sum('total_time');
        //get user roll call of month
        $rolCallMonth = RollCall::where('day', "LIKE", "%" . $dateTimeMonth . "%")
            ->paginate(config('app.pagination'));
        $dataNameMonth = RollCall::where('day', "LIKE", "%" . $dateTimeMonth . "%")
            ->select('user_id', DB::raw('SUM(total_time) as total_times'))
            ->groupBy('user_id')
            ->paginate(config('app.pagination'));
        $dataSumRollCallMonth = RollCall::where('day', "LIKE", "%" . $dateTimeMonth . "%")
            ->sum('total_time');
        $data = [
            'dateTimeMonth' => $dateTimeMonth,
            'sumRollCallMonth' => $sumRollCallMonth,
            'rolCallMonth' => $rolCallMonth,
            'dataNameMonth' => $dataNameMonth,
            'dataSumRollCallMonth' => $dataSumRollCallMonth,
        ];
        return view('admin.roll-call.update_statistic', $data);
    }
}
