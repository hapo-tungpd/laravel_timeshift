<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Overtime;
use App\Models\User;

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
        $data = [
            'overTimeDay' => $overTimeDay,
            'sumOverTimeToday' => $sumOverTimeToday,
            'overTimeMonth' => $overTimeMonth,
            'sumOverTimeMonth' => $sumOverTimeMonth,
            'overTime' => $overTime,
        ];
        return view('admin.overtime.statistic', $data);
    }
}
