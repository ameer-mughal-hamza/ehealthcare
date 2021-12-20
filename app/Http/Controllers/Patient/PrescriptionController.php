<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class PrescriptionController extends Controller
{
    public function index()
    {
        $prescriptions = Prescription::with([
            'doctor',
            'doctor.user',
            'patient',
            'patient.user'
        ])->whereHas('patient.user', function ($query) {
            $query->where('user_id', auth()->user()->id);
        })->get();

        $display = [
            'title' => 'Patient Prescriptions',
            'prescriptions' => $prescriptions
        ];

        return view('patient/prescriptions/index')->with($display);
    }

    public function show($id)
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
            'date' => Carbon::parse($prescription->created_at)->format('d F Y'),
            'role' => 3,
            'medicine' => Collection::make(json_decode($prescription->medicine))->all()
        ];

        return view('shared/prescription')->with($display);
    }
}
