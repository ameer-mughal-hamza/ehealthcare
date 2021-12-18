<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrescriptionController extends Controller
{
    public function save(Request $request)
    {
        $medicine = new Prescription();
        $medicine->doctor_id = $request->doctor_id;
        $medicine->patient_id = $request->user_id;
        $medicine->medicine = json_encode($request->prescriptions);
        $medicine->save();

        $saved = false;
        if ($medicine) {
             $saved = true;
        }

        return response()->json([
            'data' => $medicine,
            'saved' => $saved
        ], 200);
    }
}
