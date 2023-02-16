<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CategoryController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('admin')) {
            $categories = category::all();
            return view('admin.categories')->with('categories', $categories);
        } else {
            abort(403, 'Unauthorized Action.');
        }
    }
    public function store(Request $req)
    {
        if (Auth::user()->hasRole('admin')) {
            $req->validate(
                [
                    'cat_name' => 'required',
                ]
            );
            category::create(
                [
                    'cat_name' => $req->cat_name,
                ]
            );
            return response()->json([
                'success' => 'Data has been added succesfully',
            ], 200);
        } else {
            abort(403, 'Unauthorized Access');
        }
    }

    public function getCategories()
    {
        $category = category::all();
        $response['data'] = $category;
        return response()->json($response);
    }

    public function deleteCategory(Request $req)
    {
        if (Auth::user()->hasRole('admin')) {
            $category = category::find($req->id);
            $category->delete();
            return redirect()->back()->with('deleted', 'The category deleted succesfully');
        } else {
            abort(403, 'Unauthorized Action.');
        }
    }
    public function editCategory(Request $req)
    {
        if (Auth::user()->hasRole('admin')) {
            $category = category::find($req->id);
            $category->cat_name = $req->cat_name;
            $category->save();
            return redirect()->back()->with('success', 'The Category edited succesfully');
        } else {
            abort(403, 'Unauthorized Action..');
        }
    }
}
