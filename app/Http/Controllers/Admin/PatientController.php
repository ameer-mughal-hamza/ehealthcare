<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prescription;
use App\Models\User;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        $patients = User::with(['patient'])->where([
            'role' => 1
        ])->get();
        $display = [
            'title' => 'Patient',
            'prescriptions' => $patients
        ];
        return view('admin/patient/index')->with($display);
    }

    public function detail($id)
    {
        $patient = Prescription::with(['patient', 'patient.user', 'patient.user.posts'])->where([
            'id' => $id
        ])->whereHas('patient.user', function ($query) use ($id) {
            $query->where('id', $id);
        })->get();

        dd($patient->id);

        $display = [
            'title' => "Patient Detail",
            'patient' => $patient
        ];

        return view('admin/patient/detail')->with($display);
    }
}
