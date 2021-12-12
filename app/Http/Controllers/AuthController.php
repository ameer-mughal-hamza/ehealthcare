<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
//        if (\auth()->check()) {
//            return redirect()->route('home');
//        }
        $display = [
            'title' => getTitle('Login')
        ];

        return view('landing-page/login')->with($display);
    }

    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if (auth('web')->attempt(array($fieldType => $input['email'], 'password' => $input['password']))) {
            return redirect()->route('home');
        } else {
            return redirect()->route('login')->with('error', 'Email-Address And Password Are Wrong.');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('/login');
    }

    public function showRegister()
    {
        $display = [
            'title' => 'Register a new Account',
            'minDate' => '2000-01-01'
        ];
        return view('landing-page/register')->with($display);
    }

    public function register(Request $request)
    {
        $fields = ['first_name', 'last_name', 'email', 'password', 'role', 'date_of_birth'];


        $patient = new Patient();
        $patient->mrn = getRandomMRN();

        $request->validate([
            'first_name' => 'required|max:26',
            'last_name' => 'required|max:26',
            'email' => 'required|email',
            'date_of_birth' => 'date_format:Y-m-d|before:now',
            'password' => 'required|confirmed',
        ]);

        $user = new User();
        foreach ($fields as $field) {
            switch ($field) {
                case 'role':
                    $user[$field] = 1;
                    break;

                case 'password':
                    $user[$field] = Hash::make($request->input($field));
                    break;

                default:
                    $user[$field] = $request->input($field);
            }
        }

        $user->save();
        $user->patient()->save($patient);

        Auth::loginUsingId($user->id);

        return redirect('/home');
    }
}
