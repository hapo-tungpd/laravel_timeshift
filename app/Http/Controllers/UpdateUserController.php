<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Image;
use Auth;
use Carbon\Carbon;
use App\Models\Overtime;
use App\Models\RollCall;
use App\Models\Report;
use App\Models\Absence;

class UpdateUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $absence = Absence::where('user_id', Auth::user()->id)
            ->orderBy('updated_at', 'DESC')
            ->first();
        $report = Report::where('user_id', Auth::user()->id)
            ->orderBy('updated_at', 'DESC')
            ->first();
        $rollcall = RollCall::where('user_id', Auth::user()->id)
            ->orderBy('updated_at', 'DESC')
            ->first();
        $overtime = Overtime::where('user_id', Auth::user()->id)
            ->orderBy('updated_at', 'DESC')
            ->first();
        $data = [
            'absence' => $absence,
            'report' => $report,
            'rollcall' => $rollcall,
            'overtime' => $overtime,
        ];
        return view('user.index', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $data = [
            'user' => $user,
        ];
        return view('user.user_manage.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUserRequest $request, $id)
    {
        if ($request->hasFile('img')) {
            $imgLink = $request->file('img')->store('public/images');
            $imgLink = substr($imgLink, 7);
            $data["image"] = $imgLink;
            User::find($id)->update($data);
        }

        $user = User::findOrFail($id);
        $user -> name = $request->input('name');
        $user -> phone = $request->input('phone');
        if ($request->input('birthday') != null) {
            $user -> birthday = Carbon::createFromFormat('d-m-Y', $request->input('birthday'));
        }
        $user -> gender = $request->input('gender');
        $user -> address = $request->input('address');
        $user -> JLPT = $request->input('JLPT');
        $user->save();
        return redirect()->route('profile.index', [
            'id' => $id,
        ]);
    }
}
