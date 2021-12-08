<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    public function show($id)
    {
        $query = Medicine::query();
        $prescription = $query->where([
            'id' => $id
        ])->first();

        return response()->json([
            'data' => $prescription
        ]);
    }

    public function create(Request $request)
    {
        $medicine = new Medicine();

        $medicine->doctor_id = 2;
        $medicine->patient_id = 1;
        $medicine->medicine = json_encode($request->all());

        $medicine->save();

        return response()->json(['data' => $medicine]);
    }

    public function edit(Request $request)
    {
        $query = Medicine::query();
        $prescription = $query->where([
            'id' => $request->id
        ])->first();

        $prescription->doctor_id = $request->doctor_id;
        $prescription->patient_id = $request->patient_id;
        $prescription->medicine = json_encode($request->all());

        $prescription->save();

        return response()->json(['data' => $prescription]);
    }

    public function delete(Request $request)
    {
        $prescription = Medicine::find($request->id);

        if ($prescription) {
            $prescription->delete();
        }

        return redirect()->back();
    }
}
