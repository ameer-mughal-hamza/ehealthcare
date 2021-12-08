<?php

use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/check', function (){
    return response()->json([
        'data' => "Ameer Hamza"
    ], 200);
});

Route::apiResource('/blogs', "Api\BlogController");
Route::get('/prescription/{id}', function ($id) {
    return Medicine::where('id', $id)->first();
});
Route::post('/prescription', function (Request $request) {
    $medicine = new Medicine();
    $medicine->doctor_id = 2;
    $medicine->patient_id = 1;
    $medicine->medicine = json_encode($request->all());
    $medicine->save();
    return response()->json(['data' => $medicine]);
});
