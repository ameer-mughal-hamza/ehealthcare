<?php

use App\Models\Medicine;
use App\Models\Post;
use App\Models\User;
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

Route::get('/check', function () {
    return response()->json([
        'data' => "Ameer Hamza"
    ], 200);
});


Route::post("/search-doctor/initial", function () {
    $doctors = User::with([
        'doctor',
        'doctor.user',
        'address'
    ])->where([
        'role' => 2
    ])->get();

    foreach ($doctors as $doctor) {
        $address = $doctor->address;

        $latLonObj = getLatLonOfZipCode($address->postal_code);

        $featureObjs[] = [
            'type' => 'Feature',
            'geometry' => [
                'type' => 'Point',
                'coordinates' => $latLonObj,
            ],
            'properties' => [
                'title' => $doctor->name,
                'description' => $doctor->doctor->description,
                'language' => getLanguageValue($doctor->doctor->language)->value,
                'mobile' => $doctor->doctor->mobile ?? '',
            ]
        ];
    }

    $features = [
        'type' => 'FeatureCollection',
        'features' => $featureObjs
    ];

    return response()->json([
        'data' => json_encode($features)
    ]);
});
Route::post("/search-doctor", "DoctorController@searchDoctor");

Route::apiResource('/blogs', "Api\BlogController");
Route::get('/prescription/{id}', function ($id) {
    return Medicine::where('id', $id)->first();
});

Route::post('/post/submit', function (Request $request) {
    $post = new \App\Models\Post();

    $post->description = $request->description;
    $post->user_id = $request->user_id;
    $post->save();

    return response()->json([
        'data' => Post::with(['user', 'comments'])->where('id', $post->id)->first()
    ]);
});

Route::get('/medicines', function () {
    $medicines = Medicine::all()->pluck('name');
    return response()->json([
        'medicines' => $medicines
    ]);
});

Route::post('/prescription', "Api\PrescriptionController@save");

//Route::post('/prescription', function (Request $request) {
//    dd($request->all());
//    $medicine = new Medicine();
//    $medicine->doctor_id = 2;
//    $medicine->patient_id = 1;
//    $medicine->medicine = json_encode($request->all());
//    $medicine->save();
//    return response()->json(['data' => $medicine]);
//});
