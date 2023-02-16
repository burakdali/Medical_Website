<?php

namespace App\Http\Controllers;

use App\Models\article;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticlesController extends Controller
{

    public function index()
    {
        $articles = article::all();
        if (Auth::user()->hasRole('admin')) {
            return view('admin.articles')->with('articles', $articles);
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    public function addNew()
    {
        if (Auth::user()->hasRole('admin')) {
            return view('admin.addNewArticle');
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    public function storeArticle(Request $req)
    {
        if (Auth::user()->hasRole('admin')) {
            $req->validate(
                [
                    'title' => 'required',
                    'content' => 'required'
                ]
            );
            $req_data = [
                "category_id" => $req->categories,
                "title" => $req->title,
                "content" => $req->content,
            ];
            $static_data = [
                "user_id" => Auth::user()->id,
            ];
            $data = array_merge($static_data, $req_data);
            article::create($data);
            return response()->json([
                'success' => 'Article has been added succesfully',
            ], 200);
        } else {
            abort(403, 'Unauthorized action.');
        }
    }
    public function ArticleSpec(Request $req)
    {
        $data = article::find($req->id);
        return view("admin.article")->with('data', $data);
    }
    public function nextArticle(Request $req)
    {
    }
}
