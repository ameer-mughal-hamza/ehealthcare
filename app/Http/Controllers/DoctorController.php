<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function dashboard()
    {
        $display = [
            'title' => 'Doctor Dashboard | E Health Care'
        ];
        return view('doctors/dashboard')->with($display);
    }

    public function index($id)
    {
        $doctor = User::whereHas('doctor', function ($q) {
            $q->where('is_active', 1);
        })->with('doctor')->where([
            'id' => $id
        ])->find($id);

        $display = [
            'doctor' => $doctor,
            'title' => getTitle('Login')
        ];

        return view('landing-page/doctors/show')->with($display);
    }
}
