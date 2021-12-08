'<?php

use App\Events\PostEvent;
use App\Models\User;
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
Route::group(['prefix' => 'admin'], function () {
    //All the routes that belongs to the group goes here
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
Route::group(['prefix' => 'doctor', 'middleware' => 'auth'], function () {
    //All the routes that belongs to the group goes here
    Route::get('dashboard', function () {
    });
});


// Routes for Patients
Route::group(['prefix' => 'patient', 'middleware' => 'auth'], function () {
    //All the routes that belongs to the group goes here
    Route::get('dashboard', function () {
    });
});

Route::group(['prefix' => '/'], function () {
    //All the routes that belongs to the landing page goes here
    Route::get('home', "HomeController@index")->name("home");
    Route::get('doctor-detail/{id}', "DoctorController@index")->name("home");
    Route::get('contact', "ContactController@index");
    Route::get('login', "AuthController@index");
    Route::post('login', "AuthController@login")->name('login');
    Route::post('logout', "AuthController@logout");
    Route::get('register', "AuthController@showRegister");
    Route::post('register', "AuthController@register");
    Route::get('find-a-doctor', function () {
        return view('landing-page/doctor-page')->with(['title' => 'Search Doctor']);
    });
});


Route::get('test-event', function () {
    event(new PostEvent('This is a new message!', User::find(1)));
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
//Route::post('/logout', "AuthController@logout");
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

Route::middleware('checkUserRole')->get('/admin', function () {
    return view('admin/home');
});

Route::middleware('checkUserRole')->get('/admin/doctors', function () {
    return view('admin/doctors/index');
});

Route::middleware('checkUserRole')->get('/admin/doctors/detail', function () {
    return view('admin/doctors/detail');
});

Route::middleware('checkUserRole')->get('/admin/doctors/add', function () {
    return view('admin/doctors/add');
});

Route::middleware('checkUserRole')->get('/admin/patients/view-all', function () {
    return view('admin/patients');
});

Route::middleware('checkUserRole')->get('/admin/patients/add', function () {
    return view('admin/patients');
});

Route::middleware('checkUserRole')->get('/admin/blogs', function () {
    return view('admin/blogs/index');
});

Route::middleware('checkUserRole')->get('/admin/blogs/{id}', function () {
    return view('admin/blogs/details');
});

Route::get('/doctors/prescription', function () {
    return view('doctors/perscription');
});

Route::get('auth/google', 'SocialController@redirectToGoogle');
Route::get('auth/google/callback', 'SocialController@handleGoogleCallback');

Route::get('auth/facebook', 'SocialController@redirectToFacebook');
Route::get('auth/facebook/callback', 'SocialController@handleFacebookCallback');
