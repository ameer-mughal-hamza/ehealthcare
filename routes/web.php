'<?php

use App\Http\Services\DoctorService;
use App\Http\Services\LocationService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

// Routes for ADMIN
// , 'middleware' => ['auth', 'email_verified']
Route::group(['prefix' => 'admin'], function () {
    //All the routes that belongs to the group goes here
    Route::get('dashboard', "Admin\AdminController@dashboard");
    Route::get('doctors/add', "Admin\DoctorController@showAddDoctor");

    Route::get("doctors/detail/{id}", "Admin\DoctorController@detail");

    Route::get('add-patient', function () {
        return view('admin/patient/add-patient');
    });

    Route::get('view/category/all', "CategoryController@index");
    Route::get('add/category', "CategoryController@add");
    Route::post('add/category', "CategoryController@create")->name('add_new_category');
    Route::get('edit/{slug}/category', "CategoryController@edit");

    Route::get('view/medicine/all', "MedicineController@index")->name('medicine_index');
    Route::get('add/medicine', "MedicineController@add");
    Route::post('add/medicine', "MedicineController@create")->name('add_new_medicine');
    Route::get('edit/{slug}/medicine', "MedicineController@edit");
    Route::post('update/{slug}/medicine', "MedicineController@update")->name('update_medicine');

    Route::get('view/messages/all', "MessageController@index")->name('view_all_messages');
    Route::get('view/message/{id}', "MessageController@show")->name('view_message');
    Route::get('delete/message/{id}', "MessageController@delete")->name('delete_message');

    Route::get('posts', "PostController@index")->name('view_all_posts');
    Route::get('/post/{id}', "PostController@show")->name('view_post');
    Route::get('/post/{id}/delete', "MessageController@delete")->name('delete_post');

    Route::get('become-a-doctor/requests', "Admin\DoctorController@becomeADoctorRequests");
    Route::get('become-a-doctor/requests/view/{id}', "Admin\DoctorController@becomeADoctorRequestsView");

    Route::get('approve-doctor/{id}', "Admin\DoctorController@approveDoctor")->name('approve_doctor_account');

    Route::get('/doctors/view-all', "Admin\DoctorController@index");

    Route::get('/prescriptions', "Admin\PatientController@index");
    Route::get('/patient/detail/{id}', "Admin\PatientController@detail");

    Route::get('add-doctor', function () {
        return view('admin/doctors/add-doctor');
    });
});


// Routes for Doctors
// , 'middleware' => ['auth', 'email_verified']

Route::group(['prefix' => 'doctor', 'middleware' => ['auth', 'check_doctor']], function () {
    //All the routes that belongs to the group goes here
    Route::get('dashboard', "DoctorController@dashboard");
    Route::get('prescriptions', "Doctor\PatientController@index")->name('view_all_prescriptions');
    Route::get('add/new/patient', "Doctor\PatientController@showAddNewPatientForm")->name('doctor_add_new_patient');
    Route::post('add/new/patient', "Doctor\PatientController@addNewPatient")->name('doctor_prescribe_medicine');
    Route::get('/prescribe/medicine', "Doctor\PatientController@prescribeMedicine");

    Route::get('account-settings', "DoctorController@profile");
    Route::post('account-settings', "DoctorController@updateProfile")->name('doctor_update_profile');
//    Route::get('prescriptions', "DoctorController@showPatients");
    Route::get('change-password', "DoctorController@password")->name('patient_change_password');;
    Route::post('change-password', "DoctorController@updatePassword")->name('patient_update_password');;
});

// , 'middleware' => ['auth', 'email_verified']
// Routes for Patients
Route::group(['prefix' => 'patient'], function () {
    //All the routes that belongs to the group goes here
    Route::get('dashboard', "PatientController@index");

    Route::get('prescriptions', "PatientController@showPrescriptions")->name('patient_profile');
    Route::get('prescriptions/view/1', "PatientController@showPrescriptionsDetail")->name('patient_profile');

    Route::get('profile', "PatientController@changePassword")->name('patient_profile');
    Route::post('profile', "PatientController@changePassword")->name('updatepatient_profile');
    Route::get('change-password', "PatientController@changePassword")->name('patient_change_password');
    Route::post('change-password', "PatientController@updatePassword")->name('patient_update_password');
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
});

Route::group(['prefix' => '/', 'middleware' => ['auth']], function () {
    //All the routes that belongs to the landing page goes here
    Route::get('doctor-detail/{id}', "DoctorController@index");


    Route::get('find-a-doctor', function (LocationService $locationService, DoctorService $doctorService) {
        return view('landing-page/doctor-page')->with([
            'title' => 'Search Doctor',
            'municipalities' => $locationService->getMunicipalities(),
            'categories' => $doctorService->getCategories(),
        ]);
    });
});

Route::get('/post', function () {
    return view('landing-page/posts/index')->with(['title' => 'Posts']);
});

Route::get('/post/1', function () {
    return view('landing-page/posts/show')->with(['title' => 'Posts']);
});

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

Route::get('/reset-password', function () {
    return view('landing-page/contact')->with(['title' => 'Reset password']);
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
