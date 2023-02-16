<?php

namespace App\Http\Controllers;

use App\Models\consult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsultantsController extends Controller
{
    public function index(Request $req)
    {
        if (Auth::user()->hasRole('admin')) {
            return view('admin.consultants');
        } else if (Auth::user()->hasRole('user')) {
            $consults = consult::where("user_id", $req->id);
        }
    }
    public function askForConsult()
    {
    }
}
