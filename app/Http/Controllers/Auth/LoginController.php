<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function loginForm()
    {
        if (Auth::guard('web')->check()) {
            return redirect()->route('profile.index');
        }
        return view('user.login');
    }

    public function login(Request $request)
    {
        $check = Auth::guard('web')->attempt($request->only(['email', 'password']));

        if ($check) {
            return redirect()->route('profile.index');
        } else {
//            return redirect()->route('user.login');
            return redirect()->back()->withInput($request->only('email', 'remember'));
        }
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('user.login-form');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
