<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AdminController extends Controller
{
    public function loginForm() {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.index');
        }
        return view('admin.login');
    }

    public function login (Request $request) {
//        dd($request->only(['username', 'password']));

        $check = Auth::guard('admin')->attempt($request->only(['username', 'password']));

//         dd($request->all());


        if ($check) {
            return redirect()->route('admin.index');
        } else {
            return redirect()->route('admin.login');
        }
    }

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login-form');
    }
}
