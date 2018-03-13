<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Absence;

class AbsenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $absences = Absence::orderBy('updated_at', 'desc')->paginate(config('app.user_pagination'));
        $data = [
            'absences' => $absences
        ];
        return view('admin.absence.index', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Absence::findOrFail($id)->delete();
        return response()->json([
            'message' => 'Delete success'
        ]);
    }
}
