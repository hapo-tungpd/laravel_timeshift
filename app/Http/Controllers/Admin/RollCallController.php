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
        $from_time = $request->from_date;
        $to_time = $request->to_date;
        $employees = RollCall::whereBetween('day', [$from_time, $to_time])
            ->paginate(config('app.user_pagination'));
        $sum_time = RollCall::whereBetween('day', [$from_time, $to_time])->sum('total_time');
        return view('admin.roll-call.search', compact('employees', 'sum_time'));
    }

    public function statistic()
    {
        $rollCall = RollCall::orderBy('updated_at', 'desc')->paginate(config('app.user_pagination'));
        $date = Carbon::now();
        $dateTimeDay = substr($date, 0, 10);
        $sumRollCallToday = RollCall::where('day', "LIKE", "%" . $dateTimeDay . "%")
            ->sum('total_time');
        $rollCallDay = RollCall::where('day', "LIKE", "%" . $dateTimeDay . "%")
            ->paginate(config('app.pagination'));
        $dateTimeMonth = substr($date, 0, 7);
        $sumRollCallMonth = RollCall::where('day', "LIKE", "%" . $dateTimeMonth . "%")
            ->sum('total_time');
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
//        dd($dataNameMonth);
        $dataSumRollCallMonth = RollCall::where('day', "LIKE", "%" . $dateTimeMonth . "%")
            ->sum('total_time');
        $detail = RollCall::where('user_id', "LIKE", "%" . $rolCallMonth['user_id'] . "%")
            ->paginate(config('app.pagination'));
        $data = [
            'rollCallDay' => $rollCallDay,
            'sumRollCallToday' => $sumRollCallToday,
            'rolCallMonth' => $rolCallMonth,
            'sumRollCallMonth' => $sumRollCallMonth,
            'rollCall' => $rollCall,
            'dataName' => $dataName,
            'dataSumRollCallToDay' => $dataSumRollCallToDay,
            'dataNameMonth' => $dataNameMonth,
            'dataSumRollCallMonth' => $dataSumRollCallMonth,
            'detail' => $detail,
        ];
        return view('admin.roll-call.statistic', $data);
    }

    public function showRollCall($user_id)
    {
        $rollCallEmployee = RollCall::where('user_id', $user_id)
            ->whereMonth('day', Carbon::now()->format('m'))
            ->whereYear('day', Carbon::now()->format('Y'))
            ->paginate(config('app.pagination'));
//        dd($rollCallEmployee);
        $data = [
           'rollCallEmployee' => $rollCallEmployee,
        ];
        return view('admin.roll-call.show-roll-call', $data);
    }
}
