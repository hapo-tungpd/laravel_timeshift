<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\RollCall;
use App\Models\User;
use App\Models\Overtime;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date = Carbon::now();
        $dateTimeMonth = substr($date, 0, 7);
        $dataOvertimeMonth = Overtime::where('day', "LIKE", "%" . $dateTimeMonth . "%")
            ->select('user_id', DB::raw('SUM(total_time) as total_times'))
            ->groupBy('user_id')
            ->paginate(config('app.pagination'));

        $overTimeMonth = Overtime::where('day', "LIKE", "%" . $dateTimeMonth . "%")
            ->paginate(config('app.pagination'));

        $dataRollCallMonth = RollCall::where('day', "LIKE", "%" . $dateTimeMonth . "%")
            ->select('user_id', DB::raw('SUM(total_time) as total_times'))
            ->groupBy('user_id')
            ->paginate(config('app.pagination'));

        $rolCallMonth = RollCall::where('day', "LIKE", "%" . $dateTimeMonth . "%")
            ->paginate(config('app.pagination'));

        $dataNameRollMonth = RollCall::where('day', "LIKE", "%" . $dateTimeMonth . "%")
            ->select('user_id', DB::raw('SUM(total_time) as total_times'))
            ->groupBy('user_id')
            ->paginate(config('app.pagination'));

        $dataSumRollCallMonth = RollCall::where('day', "LIKE", "%" . $dateTimeMonth . "%")
            ->sum('total_time');

        $dataNameOverMonth = RollCall::where('day', "LIKE", "%" . $dateTimeMonth . "%")
            ->select('user_id', DB::raw('SUM(total_time) as total_times'))
            ->groupBy('user_id')
            ->paginate(config('app.pagination'));

        $data = [
            'dataNameRollMonth' => $dataNameRollMonth,
            'dataNameOverMonth' => $dataNameOverMonth,
            'dataSumRollCallMonth' => $dataSumRollCallMonth,
        ];

        return view('admin.salary.index', $data);
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
        //
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
