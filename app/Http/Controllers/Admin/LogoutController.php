<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LogoutController extends Controller
{
    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/admin')->with(session()->flash('alert-success', 'Successfully Loggedout'));
    }

    public function franchiseLogout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/franchise-login')->with(session()->flash('alert-success', 'Successfully Loggedout'));
    }
    public function memberLogout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/vivah-mitra-login')->with(session()->flash('alert-success', 'Successfully Loggedout'));
    }
}
