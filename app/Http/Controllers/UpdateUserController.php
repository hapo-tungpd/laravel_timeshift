<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Image;
use Auth;
use Carbon\Carbon;

class UpdateUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        dd(Auth::user());
        return view('user.index');
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
     *
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $data = [
            'user' => $user,
        ];
        return view('user.usermanage.edit', $data);
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
        $user -> email = $request->input('email');
//        dd($user->all());
        $user->save();
        return redirect()->route('user.index', [
            'id' => $id,
        ]);
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
