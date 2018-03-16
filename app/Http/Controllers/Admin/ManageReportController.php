<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\User;
use Auth;

class ManageReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $report = Report::orderBy('updated_at', 'desc')->paginate(config('app.report_pagination'));
        $data = [
          'report' => $report,
        ];
        return view("admin.report-manage.index", $data);
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
        return view('admin.report-manage.show', $data);
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
        return response()->json([
            'message' => 'Delete success'
        ]);
    }
}
