<?php

namespace App\Http\Controllers;

use App\Models\article;
use App\Models\consult;
use App\Http\Controllers\ArticlesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('admin')) {
            $article = article::all('title', 'number_of_views', 'created_at');
            $consultants = consult::all();
            $data = [
                'articles' => $article,
                'consults' => $consultants
            ];
            return view('admin.dashboard')->with('data', $data);
        } else if (Auth::user()->hasRole('doctor')) {
            return view('doctor.dashboard');
        } else {
            return view('user.home');
        }
    }
    public function homeNavigator()
    {
        if (Auth::user()->hasRole('admin')) {
            return view('admin.welcome');
        } else if (Auth::user()->hasRole('doctor')) {
            return view('doctor.welcome');
        } else if (Auth::user()->hasRole('user')) {
            $articles = article::all();
            return view('user.home')->with('articles', $articles);
        }
    }
}
