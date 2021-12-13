<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function showPrescriptions()
    {
        return view('patient/prescriptions/index');
    }

    public function showPrescriptionsDetail()
    {
        return view('patient/prescriptions/show');
    }

    public function index()
    {
        return view('patient/dashboard');
    }

    public function changePassword()
    {
        return view('patient/change-password');
    }

    public function updatePassword(Request $request)
    {
        return redirect()->back();
    }
}
