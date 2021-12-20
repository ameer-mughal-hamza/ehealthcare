<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Prescription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class PatientController extends Controller
{
    public function index()
    {
        $prescriptions = Prescription::with([
            'doctor',
            'doctor.user',
            'patient',
            'patient.user'
        ])->get()->unique('patient_id');

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
        }

        return redirect()->back();
    }

    public function show($id)
    {
        $prescriptions = Prescription::with([
            'doctor',
            'doctor.user',
            'patient',
            'patient.user'
        ])->whereHas('patient', function ($query) use ($id) {
            $query->where('user_id', $id);
        })->get();

        $display = [
            'title' => 'Doctor | Prescriptions',
            'prescriptions' => $prescriptions,
            'patient' => $prescriptions[0]->patient->user
        ];

        return view('doctors/prescriptions/show')->with($display);
    }

    public function showPrescription($id)
    {
        $prescription = Prescription::with([
            'doctor',
            'doctor.user',
            'doctor.user.address',
            'patient',
            'patient.user'
        ])->where([
            'id' => $id
        ])->first();

        $address = $prescription->doctor->user->address;
        $address = "$address->street, $address->postal_code <br>$address->muncipility, $address->city, $address->country";

//        dd($address);

        $display = [
            'title' => 'Doctor | Prescriptions',
            'prescription' => $prescription,
            'doctor' => $prescription->doctor->user,
            'patient' => $prescription->patient->user,
            'mobile' => $prescription->doctor->mobile,
            'address' => $address,
            'role' => 2,
            'date' => Carbon::parse($prescription->created_at)->format('d F Y'),
            'medicine' => Collection::make(json_decode($prescription->medicine))->all()
        ];

        return view('shared/prescription')->with($display);
    }

    public function printPrescription($id)
    {
        $prescription = Prescription::with([
            'doctor',
            'doctor.user',
            'doctor.user.address',
            'patient',
            'patient.user'
        ])->where([
            'id' => $id
        ])->first();

        $address = $prescription->doctor->user->address;
        $address = "$address->street, $address->postal_code <br>$address->muncipility, $address->city, $address->country";

        $patient = $prescription->patient->user;

        $display = [
            'title' => "Prescription | $patient->name",
            'prescription' => $prescription,
            'doctor' => $prescription->doctor->user,
            'patient' => $patient,
            'mobile' => $prescription->doctor->mobile,
            'address' => $address,
            'date' => Carbon::parse($prescription->created_at)->format('d F Y'),
            'medicine' => Collection::make(json_decode($prescription->medicine))->all()
        ];
        return view('shared.prescription-print')->with($display);
    }

    public function prescribeMedicine()
    {
        $user = User::where([
            'role' => 3,
            'is_verified' => 1
        ])->first();

        if ($user) {
            return view('doctors/prescriptions/prescribe-medicine')->with([
                'title' => 'Prescribe Medicine',
                'user' => $user
            ]);
        }

        return redirect()->back();
    }
}
