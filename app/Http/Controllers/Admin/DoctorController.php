<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\User;
use App\Notifications\DoctorAccountVerifiedNotification;
use App\Notifications\WelcomeEmailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use PhpParser\Comment\Doc;

class DoctorController extends Controller
{
    public function showAddDoctor()
    {
        $display = [
            'title' => 'Add Doctor'
        ];

        return view('admin/doctors/add-doctor')->with($display);
    }

    public function index()
    {
        $doctors = User::with(['doctor', 'categories'])
            ->where('role', 2)->get();

        $display = [
            'title' => 'Doctors',
            'doctors' => $doctors
        ];
        return view('admin/doctors/index')->with($display);
    }

    public function detail($id)
    {
        $doctor = User::with(['doctor', 'categories', 'address'])
            ->where([
                'role' => 2,
                'id' => $id
            ])->first();

        $display = [
            'title' => 'Doctor Detail',
            'doctor' => $doctor
        ];

        return view('admin/doctors/detail')->with($display);
    }

    public function becomeADoctorRequests()
    {
        $requests = User::with(['doctor'])->whereHas('doctor', function ($query) {
            $query->where('is_active', 0);
        })->where([
            'role' => 2
        ])->get();

        $display = [
            'title' => 'Become a Doctor',
            'requests' => $requests
        ];

        return view('admin/become-a-doctor/index')->with($display);
    }

    public function becomeADoctorRequestsView($id)
    {
        $request = User::with(['doctor', 'categories', 'address'])->whereHas('doctor', function ($query) {
            $query->where('is_active', 0);
        })->where([
            'role' => 2
        ])->first();

        if (!$request) {
            return redirect('/admin/dashboard');
        }

        $address = $request->address->street . ", " . $request->address->postal_code . " " . $request->address->muncipility . ", " . $request->address->city . ", " . $request->address->country;

        $display = [
            'title' => 'Become a Doctor',
            'request' => $request,
            'address' => trim($address)
        ];

        return view('admin/become-a-doctor/show')->with($display);
    }

    public function approveDoctor($id)
    {
        $doctor = Doctor::where([
            'riziv_number' => $id,
            'is_active' => 0
        ])->first();

        if ($doctor) {
            Doctor::where([
                'riziv_number' => $id,
                'is_active' => 0
            ])->update([
                'is_active' => 1
            ]);
        }

        if ($user = User::find($doctor->user_id)) {
            $config = [
                'url' => url('/doctor/dashboard')
            ];

            $user->notify(new DoctorAccountVerifiedNotification($config));
        }

        return redirect()->back();
    }
}
