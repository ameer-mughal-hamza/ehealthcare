'<?php

use App\Events\PostEvent;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Routes for ADMIN
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'email_verified']], function () {
    //All the routes that belongs to the group goes here
    Route::get('/', function () {
        return view("admin/home");
    });

    Route::get('add-patient', function () {
        return view('admin/patient/add-patient');
    });

    Route::get('view/category/all', "CategoryController@index");
    Route::get('add/category', "CategoryController@add");
    Route::get('edit/{slug}/category', "CategoryController@edit");

    Route::get('view/medicine/all', "MedicineController@index");
    Route::get('add/medicine', "MedicineController@add");
    Route::get('edit/{slug}/medicine', "MedicineController@edit");
    Route::post('update/{slug}/medicine', "MedicineController@update")->name('update_medicine');

    Route::get('view/messages/all', "MessageController@index")->name('view_all_messages');
    Route::get('view/message/{id}', "MessageController@show")->name('view_message');
    Route::get('delete/message/{id}', "MessageController@delete")->name('delete_message');

    Route::get('posts', "PostController@index")->name('view_all_posts');
    Route::get('/post/{id}', "PostController@show")->name('view_post');
    Route::get('/post/{id}/delete', "MessageController@delete")->name('delete_post');

    Route::get('view/doctor', function () {
        return view('admin/doctors/index');
    });

    Route::get('view/patient', function () {
        return view('admin/patient/index');
    });

    Route::get('add-doctor', function () {
        return view('admin/doctors/add-doctor');
    });
});


// Routes for Doctors
// , 'middleware' => ['auth', 'email_verified']

Route::group(['prefix' => 'doctor' , 'middleware' => ['auth', 'check_doctor']], function () {
    //All the routes that belongs to the group goes here
    Route::get('dashboard', "DoctorController@dashboard");
    Route::get('account-settings', "DoctorController@profile");
    Route::post('account-settings', "DoctorController@updateProfile")->name('doctor_update_profile');
    Route::get('patients', "DoctorController@showPatients");
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

});

Route::group(['prefix' => '/', 'middleware' => ['auth', 'email_verified']], function () {
    //All the routes that belongs to the landing page goes here
    Route::get('doctor-detail/{id}', "DoctorController@index");


    Route::get('find-a-doctor', function () {
        return view('landing-page/doctor-page')->with(['title' => 'Search Doctor']);
    });
});


Route::get('test-event/asasd', function () {
    return \Request::segment(2);
//    event(new PostEvent('This is a new message!', User::find(1)));
});

Route::get('/map', function () {
//    return \App\Models\User::all();
    return view('landing-page/map')->with(['title' => 'Search Doctor']);
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

//Route::get('/', "HomeController@index")->name("home");
//
//Route::get('/contact', "ContactController@index");
//Route::get('/login', "AuthController@index");
//Route::post('/login', "AuthController@login")->name('login');
//
//Route::get('/find-a-doctor', function () {
//    return view('landing-page/doctor-page')->with(['title' => 'Search Doctor']);
//});

Route::get('/forget-password', function () {
    return view('landing-page/forget-password')->with(['title' => 'Forget password']);
});

Route::get('/reset-password', function () {
    return view('landing-page/contact')->with(['title' => 'Reset password']);
});

// Route::middleware('checkUserRole')->get('/admin', function () {
//     return view('admin/home');
// });

Route::middleware('checkUserRole')->get('/admin/doctors', function () {
    return view('admin/doctors/index');
});

Route::middleware('checkUserRole')->get('/admin/doctors/detail', function () {
    return view('admin/doctors/detail');
});

Route::get('auth/google', 'SocialController@redirectToGoogle');
Route::get('auth/google/callback', 'SocialController@handleGoogleCallback');

Route::get('auth/facebook', 'SocialController@redirectToFacebook');
Route::get('auth/facebook/callback', 'SocialController@handleFacebookCallback');
