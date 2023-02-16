<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Session\Session;

class LogOutController extends Controller
{
    function perform()
    {
        session()->flush();
        Auth::logout();
        return redirect('/');
    }
}
