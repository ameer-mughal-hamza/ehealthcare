<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Prescription;
use App\Models\User;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        $prescriptions = Prescription::with([
            'doctor',
            'doctor.user',
            'patient',
            'patient.user'
        ])->get();

//        dd($prescriptions);

        $display = [
            'title' => 'Doctor | Prescriptions',
            'prescriptions' => $prescriptions
        ];

        return view('doctors/prescriptions/index')->with($display);
    }

    public function showAddNewPatientForm()
    {
        $display = [
            'title' => 'Add new Patient'
        ];

        return view('doctors/prescriptions/add-new-patient')->with($display);
    }

    public function addNewPatient(Request $request)
    {
        $this->validate($request, [
            'mrn' => 'required',
            'last_name' => 'required'
        ]);

        $user = User::whereHas('patient', function ($query) use ($request) {
            $query->where('mrn', $request->mrn);
        })->where([
            'role' => 3,
            'is_verified' => 1,
            'last_name' => $request->last_name
        ])->first();

        if ($user) {
            return view('doctors/prescriptions/prescribe-medicine')->with([
                'title' => 'Prescribe Medicine',
                'user' => $user
            ]);
//            return redirect('doctor/prescribe/medicine')->with([
//                'title' => 'Prescribe Medicine',
//                'user' => $user
//            ]);
        }

        return redirect()->back();
    }

    public function prescribeMedicine()
    {
//        return view('doctors/prescriptions/prescribe-medicine')->with([
//            'title' => 'Prescribe Medicine',
//            'user' => $user
//        ]);
    }
}
