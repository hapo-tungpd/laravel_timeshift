<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('user.index');
    }

    public function showChangePasswordForm()
    {
        return view('user.usermanage.changepassword');
    }

    public function changePassword(Request $request)
    {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
        // The passwords matches
            return redirect()->back()->with("error", "current password not matches with the password you provided");
        }
        if (strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
        //Current password and new password are same
            return redirect()->back()->with("error", "New Password cannot be same as your current password.");
        }
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|min:6',
        ]);
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return redirect()->back()->with("success", "Password changed successfully !");
    }
}
