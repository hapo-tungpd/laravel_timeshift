<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Report;
use App\Models\User;
use App\Http\Requests\ReportUserRequest;


class UserReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $report = Report::where('user_id', Auth::user()->id)
            ->orderby('updated_at', Auth::user()->updated_at)
            ->paginate(config('app.user_report_pagination'));
        $data = [
            'report' => $report,
        ];
        return view("user.report.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.report.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReportUserRequest  $request)
    {
        $reports = new Report();
        $reports->user_id = Auth::user()->id;
        $reports->day = $request->input('day');
        $reports->today = $request->input('today');
        $reports->tomorrow = $request->input('tomorrow');
        $reports->problem = $request->input('problem');
        $reports->save();
        return redirect()->route('report.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $report = Report::findOrFail($id);
        $user = User::findOrFail($report->user_id);
        $data = [
            'report' => $report,
            'user' => $user,
        ];
        return view('user.report.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $report = Report::findOrFail($id);
        $data = [
            'report' => $report,
        ];
        return view('user.report.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReportUserRequest  $request, $id)
    {
        $reports = Report::findOrFail($id);
        $reports->user_id = Auth::user()->id;
        $reports->day = $request->day;
        $reports->today = $request->today;
        $reports->tomorrow = $request->tomorrow;
        $reports->problem = $request->problem;
        $reports->save();
        return redirect()->route('report.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Report::findOrFail($id)->delete();
        return redirect()->route('report.index');
    }
}
