<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function getUsers()
    {
        if (Auth::user()->hasRole('admin')) {
            $users = User::whereRoleIS('user')->get();
            return view('admin.users')->with('users', $users);
        } else {
            abort(403, 'Unauthorized action.');
        }
    }
}
