<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    public function storeDepartment(Request $req)
    {
        if (Auth::user()->hasRole('admin')) {
            $req->validate(
                [
                    'name' => 'required',
                ]
            );
            Department::create(
                [
                    'name' => $req->name
                ]
            );
            return response()->json(['success' => 'Data has been added succesfully'], 200);
        } else {
            abort(403, 'Unauthoried Access..');
        }
    }
    public function getAllDepartments()
    {
        $departments = Department::all();
        $response['data'] = $departments;
        return response()->json($response);
    }
}
