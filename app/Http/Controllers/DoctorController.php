<?php

namespace App\Http\Controllers;

use App\Http\Services\DoctorService;
use App\Http\Services\LocationService;
use App\Models\Address;
use App\Models\Category;
use App\Models\Doctor;
use App\Models\Review;
use App\Models\User;
use App\Notifications\ConfirmVerificationNotfication;
use App\Notifications\DoctorAccountVerifiedNotification;
use App\Notifications\DoctorAccountVerifyNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class DoctorController extends Controller
{
    private $locationService;
    private $doctorService;

    public function __constructor(LocationService $locationService, DoctorService $doctorService)
    {
        $this->locationService = $locationService;
        $this->doctorService = $doctorService;
    }

    public function dashboard()
    {
        $display = [
            'title' => 'Doctor Dashboard | E Health Care'
        ];
        return view('doctors/dashboard')->with($display);
    }

    public function index($id)
    {
        $reviews = Review::with(['user'])->where([
            'doctor_id' => $id
        ])->get();

        $doctor = User::whereHas('doctor', function ($q) {
            $q->where('is_active', 1);
        })->with('doctor', 'categories')->where([
            'id' => $id
        ])->find($id);

        $similar_doctors = User::with(['doctor', 'categories'])
            ->whereHas('categories', function ($query) use ($doctor) {
                $query->whereIn('category_id', [1]);
            })->get();

        $display = [
            'doctor' => $doctor,
            'reviews' => $reviews,
            'similar_doctors' => $similar_doctors,
            'title' => getTitle('Login')
        ];

        return view('landing-page/doctors/show')->with($display);
    }

    public function searchDoctor(Request $request)
    {
        $query = User::query();
        $query->with([
            'doctor',
            'doctor.user',
            'address',
            'categories'
        ])->where('role', '=', 2);

        $postal_code = explode(', ', $request->payload['location']);

        if ($request->exists('payload')) {
            if ($request->payload['name']) {
                $query->where('first_name', 'like', "%" . $request->payload['name'] . "%")
                    ->orWhere('last_name', 'like', "%" . $request->payload['name'] . "%");
            }

            if ($request->payload['location'] !== "" && $request->payload['location'] !== "--- Select Area ---") {
                $query->whereHas('address', function ($q) use ($postal_code) {
                    $q->where('postal_code', $postal_code[0]);
                });
            }

            if ($request->payload['service'] !== "" && $request->payload['service'] !== "--- Select Service ---") {
                $query->whereHas('categories', function ($q) use ($request) {
                    $q->where('categories.name', $request->payload['service']);
                });
            }
        }

        $result = $query->get();

        foreach ($result as $doctor) {
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

        return [
            'list' => view('landing-page/search_doctors_result', compact('result'))->render(),
            'grid' => view('landing-page/search_doctors_grid_result', compact('result'))->render(),
            'features' => json_encode($features)
        ];
    }

    public function becomeADoctor()
    {
        $categories = Category::all();
        $municipalities = DB::table('zipcode_belgium')->get();
        $cities = DB::table('cities')->get();
        $languages = DB::table('languages')->get();
        $display = [
            'title' => 'Become a Doctor',
            'categories' => $categories,
            'municipalities' => $municipalities,
            'cities' => $cities,
            'languages' => $languages
//            'languages' => $this->doctorService->getLanguages()
        ];
        return view('landing-page.become_a_doctor')->with($display);
    }

    public function saveDoctor(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile' => 'required',
            'email' => 'required|email',
            'date_of_birth' => 'required|date|date_format:Y-m-d|before:now',
            'password' => 'required|confirmed',
            'language' => 'required',
            'postal_code' => 'required',
            'city' => 'required',
            'street' => 'required',
//            'image' => 'required|max:10000',
            'gender' => 'required',
            'description' => 'required|max:5000'
        ]);

        $doctor = new Doctor();
        $doctor->riziv_number = getRandomMRN();
        $doctor->gender = $request->gender;
        $doctor->language = $request->language;
        $doctor->mobile = $request->mobile;
        $doctor->description = $request->description;

        $post_code_muncipility = explode(',', $request->postal_code);

        $address = new Address();
        $address->street = $request->street;
        $address->postal_code = trim($post_code_muncipility[0]);
        $address->muncipility = trim($post_code_muncipility[1]);
        $address->city = $request->city;
        $address->country = "Belgium";

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->date_of_birth = $request->dob;
        $user->password = $request->password;
        $user->role = 2;
        $user->save();

//        if ($user) {
//            $originalImage = $request->file('file');
//            $thumbnailImage = Image::make($originalImage);
//            $dir_path = public_path('/profile_images/' . 31);
//            if (!is_dir($dir_path)) {
//                mkdir(public_path('/profile_images/' . 31));
//            }
//
//            $originalPath = public_path() . '/profile_images/' . $user->id . '/' . time() . '.' . $originalImage->getClientOriginalExtension();
//            $thumbnailImage->save($originalPath);
//            $doctor->picture_url = $originalImage;
//        }

        $user->categories()->attach($request->categories);
        $user->doctor()->save($doctor);
        $user->address()->save($address);

        if ($user) {
            $user = User::find(33);
            $token = Crypt::encryptString($user->id);
            $user->token = $token;
            $user->save();
            $config = [
                'url' => route('verify_doctor_account', ['token' => $token])
            ];

            $user->notify(new DoctorAccountVerifyNotification($config));
            session()->flash('doctor_account_created', 'Your account has been created successfully. Please use the link in the email to verfy your account.');
            session()->flash('info', 'You will be notified when Admin approve your account.');
            session()->flash('verify_account_email', $user->email);
        }

        return redirect()->back();
    }

    public function verifyDoctorAccount($token)
    {
        $decryptId = Crypt::decryptString($token);

        $user = User::where([
            'id' => $decryptId,
            'is_verified' => 0,
            'token' => $token
        ])->first();

        if ($user) {
            $user->is_verified = 1;
            $user->token = null;
            $user->save();

            // Send an confirmation email that your account is verified.
            $display = [
                'url' => url('/home')
            ];
            $user->notify(new ConfirmVerificationNotfication($display));

            return view('verify-account-success')->with([
                'title' => 'Account Verified'
            ]);
        }

        return redirect()->route('login');
    }

    public function saveImage($file)
    {

    }
}
