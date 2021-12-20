<?php

namespace App\Http\Controllers\Admin;

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
        $patients = User::with(['patient'])->where([
            'role' => 3
        ])->get();

        $display = [
            'title' => 'Patient',
            'prescriptions' => $patients
        ];
        return view('admin/patient/index')->with($display);
    }

    public function detail($id)
    {
        $prescriptions = Prescription::with(['patient', 'patient.user', 'patient.user.posts'])
            ->whereHas('patient.user', function ($query) use ($id) {
                $query->where('id', $id);
            })->get();

        $display = [
            'title' => "Patient Detail",
            'prescriptions' => $prescriptions,
            'patient' => $prescriptions[0]->patient->user
        ];

        return view('admin/patient/detail')->with($display);
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

        $display = [
            'title' => 'Doctor | Prescriptions',
            'prescription' => $prescription,
            'doctor' => $prescription->doctor->user,
            'patient' => $prescription->patient->user,
            'mobile' => $prescription->doctor->mobile,
            'address' => $address,
            'role' => 1,
            'date' => Carbon::parse($prescription->created_at)->format('d F Y'),
            'medicine' => Collection::make(json_decode($prescription->medicine))->all()
        ];

        return view('shared/prescription')->with($display);
    }
}
