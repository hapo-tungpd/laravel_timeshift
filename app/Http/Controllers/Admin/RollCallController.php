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
    public function index(Request $request)
    {
        if ($request->has('rollcall')) {
            $dateTimeMonth = $request->input('rollcall');
            $rollCall = RollCall::whereDate('day', $dateTimeMonth)
                ->paginate(config('app.pagination'));
            $data = [
                'rollCall' => $rollCall,
                'dateTimeMonth' => $dateTimeMonth,
            ];
        } else {
            $dateTimeMonth = Carbon::now()->format('Y-m-d');
            $rollCall = RollCall::whereDate('day', $dateTimeMonth)
                ->paginate(config('app.pagination'));
            $data = [
                'rollCall' => $rollCall,
                'dateTimeMonth' => $dateTimeMonth,
            ];
        }

        return view('admin.roll_call.index', $data);
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
        return view('admin.roll_call.search', compact('employees', 'sumTime'));
    }

    public function statistic(Request $request)
    {
        if ($request->has('month')) {
            $dateTimeMonth = $request->input('month'); //2018-02
            $month =substr($dateTimeMonth, 5, 7);
            $year =substr($dateTimeMonth, 0, 4);
            $sumRollCallMonth = RollCall::whereMonth('day', $month)
                ->whereYear('day', $year)
                ->sum('total_time');
            $rolCallMonths = RollCall::whereMonth('day', $month)
                ->whereYear('day', $year)
                ->orderBy('day')
                ->paginate(config('app.pagination'));
            $statisticRollCallMonths = RollCall::whereMonth('day', $month)
                ->whereYear('day', $year)
                ->select('user_id', DB::raw('SUM(total_time) as total_times'))
                ->groupBy('user_id')
                ->paginate(config('app.pagination'));
            $dataSumRollCallMonth = RollCall::whereMonth('day', $month)
                ->whereYear('day', $year)
                ->sum('total_time');
            $data = [
                'dateTimeMonth' => $dateTimeMonth,
                'sumRollCallMonth' => $sumRollCallMonth,
                'rolCallMonths' => $rolCallMonths,
                'statisticRollCallMonths' => $statisticRollCallMonths,
                'dataSumRollCallMonth' => $dataSumRollCallMonth,
            ];
            return view('admin.roll_call.update_statistic', $data);
        }
        $rollCall = RollCall::orderBy('updated_at', 'desc')->paginate(config('app.user_pagination'));
        $dateTimeDay = Carbon::now()->format('Y-m-d');
        $rollCallDays = RollCall::whereDate('day', $dateTimeDay)//roll call today
            ->orderBy('start_time', 'DESC')
            ->paginate(config('app.pagination'));
        $sumRollCallToday = RollCall::whereDate('day', $dateTimeDay)->sum('total_time');
        $dateTimeMonth = Carbon::now()->format('Y-m'); //2018-03
        $sumRollCallMonth = RollCall::whereMonth('day', Carbon::now()->format('m')) //roll coll of month
            ->whereYear('day', Carbon::now()->format('Y'))
            ->sum('total_time');
        $rolCallMonths = RollCall::whereMonth('day', Carbon::now()->format('m'))
            ->whereYear('day', Carbon::now()->format('Y'))
            ->orderBy('day', 'DESC')
            ->paginate(config('app.pagination'));
        $statisticRollCallMonths = RollCall::whereMonth('day', Carbon::now()->format('m'))
            ->whereYear('day', Carbon::now()->format('Y'))
            ->select('user_id', DB::raw('SUM(total_time) as total_times'))
            ->groupBy('user_id')
            ->orderBy('day', 'DESC')
            ->paginate(config('app.pagination'));
        $dataSumRollCallMonth = RollCall::whereMonth('day', Carbon::now()->format('m'))
            ->whereYear('day', Carbon::now()->format('Y'))
            ->sum('total_time');
        $data = [
            'dateTimeMonth' => $dateTimeMonth,
            'rollCallDays' => $rollCallDays,
            'sumRollCallToday' => $sumRollCallToday,
            'rolCallMonths' => $rolCallMonths,
            'sumRollCallMonth' => $sumRollCallMonth,
            'rollCall' => $rollCall,
            'statisticRollCallMonths' => $statisticRollCallMonths,
            'dataSumRollCallMonth' => $dataSumRollCallMonth,
        ];
        return view('admin.roll_call.statistic', $data);
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
        return view('admin.roll_call.show_roll_call', $data);
    }
}
