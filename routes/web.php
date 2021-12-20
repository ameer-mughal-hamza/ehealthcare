<?php

use App\Http\Services\DoctorService;
use App\Http\Services\LocationService;
use App\Models\Category;
use App\Models\Review;
use App\Models\User;
use App\Notifications\ConfirmVerificationNotfication;
use App\Notifications\ForgetPasswordNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

// Routes for ADMIN
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'check_admin']], function () {
    //All the routes that belongs to the group goes here
    Route::get('dashboard', "Admin\AdminController@dashboard");
    Route::get('doctors/add', "Admin\DoctorController@showAddDoctor");

    Route::get("doctors/detail/{id}", "Admin\DoctorController@detail");

    Route::get('add-patient', function () {
        return view('admin/patient/add-patient');
    });

    Route::get('categories', "CategoryController@index")->name('category_index');
    Route::get('add/category', "CategoryController@add");
    Route::post('add/category', "CategoryController@create")->name('add_new_category');
    Route::get('edit/{slug}/category', "CategoryController@edit");
    Route::post('edit/{slug}/category', "CategoryController@update")->name('update_category');
    Route::get('category/{slug}/delete', function ($slug) {
        $category = Category::where('slug', $slug)->first();
        if ($category) {
            $category->delete();
            return redirect()->back()->with('success', 'Category deleted successfully.');
        }

        return redirect()->back()->with('error', 'There is something wrong with this request.');
    })->name('delete_category');

    Route::get('medicines', "MedicineController@index")->name('medicine_index');
    Route::get('add/medicine', "MedicineController@add");
    Route::post('add/medicine', "MedicineController@create")->name('add_new_medicine');
    Route::get('edit/{slug}/medicine', "MedicineController@edit");
    Route::post('update/{slug}/medicine', "MedicineController@update")->name('update_medicine');

    Route::get('messages', "MessageController@index")->name('view_all_messages');
    Route::get('view/message/{id}', "MessageController@show")->name('view_message');
    Route::get('delete/message/{id}', "MessageController@delete")->name('delete_message');

    Route::get('posts', "PostController@index")->name('view_all_posts');
    Route::get('/post/{id}', "PostController@show")->name('view_post');
    Route::get('/post/{id}/delete', "MessageController@delete")->name('delete_post');

    Route::get('become-a-doctor/requests', "Admin\DoctorController@becomeADoctorRequests");
    Route::get('become-a-doctor/requests/view/{id}', "Admin\DoctorController@becomeADoctorRequestsView");

    Route::get('approve-doctor/{id}', "Admin\DoctorController@approveDoctor")->name('approve_doctor_account');

    Route::get('/doctors/view', "Admin\DoctorController@index");

    Route::get('/prescriptions', "Admin\PatientController@index");
    Route::get('/patient/prescription/{id}', "Admin\PatientController@showPrescription")->name('show_patient_prescription');
    Route::get('/patient/detail/{id}', "Admin\PatientController@detail");

    Route::get('add-doctor', function () {
        return view('admin/doctors/add-doctor');
    });
});

Route::group(['prefix' => 'doctor', 'middleware' => ['auth', 'check_doctor']], function () {
    //All the routes that belongs to the group goes here
    Route::get('dashboard', "DoctorController@dashboard");
    Route::get('prescriptions', "Doctor\PatientController@index")->name('view_all_prescriptions');
    Route::get('add/new/patient', "Doctor\PatientController@showAddNewPatientForm")->name('doctor_add_new_patient');
    Route::post('add/new/patient', "Doctor\PatientController@addNewPatient")->name('doctor_prescribe_medicine');
    Route::get('/prescribe/medicine/{id}', "Doctor\PatientController@prescribeMedicine")->name('prescribe_medicine_to_existing_patient');

    Route::get('/patient/detail/{id}', "Doctor\PatientController@show")->name('show_patient_detail_to_doctor');
    Route::get('/patient/prescription/{id}', "Doctor\PatientController@showPrescription")->name('show_patient_prescription');

    Route::get('account-settings', "DoctorController@showAccountSettingsForm");
    Route::post('account-settings', "DoctorController@submitAccountSettingsForm")->name('doctor_update_profile');
    Route::get('change-password', "Doctor\ProfileController@showChangePasswordForm")->name('doctor_change_password');;
    Route::post('change-password', "Doctor\ProfileController@submitChangePasswordForm")->name('doctor_update_password');;
});

Route::get('/print/prescription/{id}', "Doctor\PatientController@printPrescription")
    ->name("print_invoice")
    ->middleware('auth');

// , 'middleware' => ['auth', 'email_verified']
// Routes for Patients
Route::group(['prefix' => 'patient', 'middleware' => ['auth', 'check_patient']], function () {
    //All the routes that belongs to the group goes here
    Route::get('dashboard', "PatientController@index");

    Route::get('prescriptions', "Patient\PrescriptionController@index")->name('patient_profile');
    Route::get('prescription/view/{id}', "Patient\PrescriptionController@show")->name('patient_prescription_view');

    Route::get('account-settings', "Patient\ProfileController@showAccountSettingsForm")->name('patient_profile');
    Route::post('account-settings', "Patient\ProfileController@submitAccountSettingsForm")->name('update_patient_profile');
    Route::get('change-password', "Patient\ProfileController@showChangePasswordForm")->name('patient_change_password');
    Route::post('change-password', "Patient\ProfileController@submitChangePasswordForm")->name('patient_update_password');
});
//

Route::group(['prefix' => '/'], function () {
    Route::get('home', "HomeController@index")->name("home");
    Route::get('login', "AuthController@index")->name('login');
    Route::post('login', "AuthController@login")->name('login');
    Route::get('register', "AuthController@showRegister");
    Route::post('register', "AuthController@register");
    Route::get('logout', "AuthController@logout");
    Route::get('contact', "ContactController@index");
    Route::post('contact', "ContactController@contactUsSubmit");

    Route::get('/doctor-account-verification/{token}', "DoctorController@verifyDoctorAccount")->name('verify_doctor_account');

    Route::get('/account-verification/{token}', "AuthController@verify_account");

    Route::get('/verify-account-success', function () {
        return view('verify-account-success')->with([
            'title' => 'Account Verified'
        ]);
    })->name('verify_account_success');

    Route::get('/verify-account', function () {
        return view('verify-email')->with([
            'title' => 'Verify Account'
        ]);
    })->name('verify_account_message');

    Route::get('become-a-doctor', "DoctorController@becomeADoctor");
    Route::post('become-a-doctor', "DoctorController@saveDoctor")->name('front_save_doctor');
    Route::post("/review/submit", function (Request $request) {

        $this->validate($request, [
            'description' => 'required|max:1500'
        ]);

        $review = new Review();

        $review->doctor_id = $request->doctor_id;
        $review->patient_id = auth()->user()->id;
        $review->rating = $request->rating;
        $review->description = $request->description;
        $review->save();

        return redirect()->back();
    })->name('submit_review');
});

Route::group(['prefix' => '/'], function () {
    Route::get('doctor-detail/{id}', "DoctorController@index");
});

Route::get('find-a-doctor', function (LocationService $locationService, DoctorService $doctorService) {
    $doctors = User::with([
        'doctor',
        'doctor.user',
        'address',
        'categories'
    ])->where([
        'role' => 2
    ])->get();

    return view('landing-page/doctor-page')->with([
        'title' => 'Search Doctor',
        'municipalities' => $locationService->getMunicipalities(),
        'categories' => $doctorService->getCategories(),
        'doctors' => $doctors
    ]);
});

Route::get('/post', function () {
    return view('landing-page/posts/index')->with(['title' => 'Posts']);
});

Route::get('/post/{id}', "PostController@show");

Route::get('/get-user', function () {
    DB::enableQueryLog();
//    return \App\Models\User::with('doctor')->get();
    \App\Models\Post::whereHas('comments', function ($q) {
        $q->whereYear('created_at', '>', 2020);
    })->get();
    dd(DB::getQueryLog());
});

Route::get('/forget-password', function () {
    return view('landing-page/forget-password')->with(['title' => 'Forget password']);
});

Route::post('/forget-password', function (Request $request) {
    $request->validate([
        'email' => 'required|email|exists:users',
    ]);

    $token = Str::random(64);

    DB::table('password_resets')->insert([
        'email' => $request->email,
        'token' => $token,
        'created_at' => Carbon::now()
    ]);

    $display = [
        'url' => url('reset-password/' . $token)
    ];

    $user = User::where('email', $request->email)->first();
    $user->notify(new ForgetPasswordNotification($display));
    return back()->with('message', 'We have e-mailed your password reset link!');
});

Route::get('/reset-password/{token}', function ($token) {
    return view('landing-page/reset-password')->with([
        'title' => 'Reset password',
        'token' => $token
    ]);
});

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'email' => 'required|email|exists:users',
        'password' => 'required|string|min:6|confirmed',
        'password_confirmation' => 'required'
    ]);


    $updatePassword = DB::table('password_resets')
        ->where([
            'email' => $request->email,
            'token' => $request->token
        ])
        ->first();

    if (!$updatePassword) {
        return back()->withInput()->with('error', 'Invalid token!');
    }

    $user = User::where('email', $request->email)->update([
        'password' => Hash::make($request->password)
    ]);

    DB::table('password_resets')->where(['email' => $request->email])->delete();

    return redirect('/login');
});

Route::middleware('checkUserRole')->get('/admin/doctors', function () {
    return view('admin/doctors/index');
});

Route::get('/admin/doctors/detail', function () {
    return view('admin/doctors/detail');
});

Route::get('auth/google', 'SocialController@redirectToGoogle');
Route::get('auth/google/callback', 'SocialController@handleGoogleCallback');

Route::get('auth/facebook', 'SocialController@redirectToFacebook');
Route::get('auth/facebook/callback', 'SocialController@handleFacebookCallback');
