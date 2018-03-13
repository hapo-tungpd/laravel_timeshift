<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Absence;
use App\Models\User;
use Auth;
use App\Http\Requests\AbsenceUserRequest;

class UserAbsenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $absence = Absence::where('user_id', Auth::user()->id)
            ->orderby('updated_at', Auth::user()->updated_at)
            ->paginate(config('app.user_pagination'));
        $data = [
            'absence' => $absence,
        ];
        return view("user.absence.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.absence.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AbsenceUserRequest $request)
    {
        $data = $request->all();
        Absence::create($data);
        return redirect()->route('absence.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $absence = Absence::findOrFail($id);
        $user = User::findOrFail($absence->user_id);
        $data = [
            'absence' => $absence,
            'user' => $user,
        ];
        return view('user.absence.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $absence = Absence::findOrFail($id);
        $data = [
            'absence' => $absence,
        ];
        return view('user.absence.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AbsenceUserRequest $request, $id)
    {
        $data = $request->all();
        $data = array_slice($data, 2);
        Absence::where('id', $id)->update($data);
        return redirect()->route('absence.index');
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
        return redirect()->route('absence.index');
    }
}
