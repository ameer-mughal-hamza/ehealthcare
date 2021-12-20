<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;
use App\Notifications\ConfirmVerificationNotfication;
use App\Notifications\WelcomeEmailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __constructor()
    {
        if (\auth()->user()->check()) {
            return redirect('/home');
        }
    }

    public function index()
    {
        $display = [
            'title' => getTitle('Login')
        ];

        return view('landing-page/login')->with($display);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if (auth('web')->attempt(array($fieldType => $input['email'], 'password' => $input['password']))) {
            return redirect()->route('home');
        } else {
            return redirect()->route('login')->with('error', 'Invalid login credentials.');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
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

        if ($user->save()) {
            $token = Crypt::encryptString($user->id);
            $user->token = $token;
            $user->save();
            $user->patient()->save($patient);
            $config = [
                'url' => url("account-verification/" . $token)
            ];

            $user->notify(new WelcomeEmailNotification($config));
        }

//        Auth::loginUsingId($user->id);

        return redirect()->route('verify_account_message');
    }

    public function verify_account($token)
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

//            $html = '';
//            $html .= "<div class='alert alert-info alert-dismissible fade show'><h4 class='alert-heading'>Congratulation!</h4>";
//            $html .= "<p>Your account has been verified succesfully.</p><hr>";
//            $html .= "<a href='{{ url('home') }}'>Go to Home</a>";

            Auth::login($user);

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
}
