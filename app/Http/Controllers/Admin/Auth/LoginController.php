<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check())
            return redirect('/home');
        return view('login');
    }
    protected function guard(){
        return Auth::guard('admin');
    }

    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect('/');
    }

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

}
