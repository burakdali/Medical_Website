<?php

namespace App\Http\Controllers;

use App\Models\Doctor_Specialization;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class DoctorsController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('admin')) {
            $doctors = User::whereRoleIs('doctor')->get();
            return view('admin.doctors')->with('doctors', $doctors);
        } else {
            abort(403, 'Unauthorized action.');
        }
    }
    public function addNewDoctor()
    {
        if (Auth::user()->hasRole('admin')) {
            return view('admin.addNewDoctor');
        } else {
            abort(403, 'Unauthorized action.');
        }
    }
    public function getAllSpecializations(Request $req)
    {
        $specs = DB::table('doctor__specializations')->where('department_id', $req->id)->get();
        $response['data'] = $specs;
        return response()->json($response);
    }
    public function storeDoctorSpecializations(Request $req)
    {

        if (Auth::user()->hasRole('admin')) {
            $req->validate(
                [
                    'name' => 'required',
                    'departmentModalSelect' => 'required',
                ]
            );
            Doctor_Specialization::create(
                [
                    'name' => $req->name,
                    'department_id' => $req->departmentModalSelect,
                ]
            );
            return response()->json(['success' => 'Data has been added succesfully'], 200);
        } else {
            abort(403, 'Unauthoried Access..');
        }
    }
    public function storeDoctor(Request $req)
    {
        if (Auth::user()->hasRole('admin')) {
            $req->validate(
                [
                    'name' => 'required',
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'phoneNumber' => ['required', 'string'],
                    'SpecializationSelect' => 'required',
                    'departmentSelect' => 'required',
                ]
            );
            $user = User::create([
                "name" => $req->name,
                "email" => $req->email,
                "phone_number" => $req->phoneNumber,
                "doctor__specialization_id" => $req->SpecializationSelect,
            ]);

            $user->attachRole('doctor');
            return response()->json(['success' => 'Doctor has been added succesfully'], 200);
        } else {
            abort(403, 'Unauthoried Access..');
        }
    }
}
