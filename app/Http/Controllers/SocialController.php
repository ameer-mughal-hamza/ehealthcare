<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Patient;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;

class SocialController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('email', $user->email)->first();
            if ($finduser) {
                Auth::login($finduser);
                return redirect('/home');
            } else {
                $patient = new Patient();
                $patient->mrn = getRandomMRN();

                $newUser = new User();
                if ($user->user->given_name && $user->user->family_name) {
                    $newUser->first_name = $user->user->given_name;
                    $newUser->last_name = $user->user->family_name;
                } else {
                    $name = preg_split('#\s+#', $user->name, 2);

                    $newUser->first_name = $name[0];
                    $newUser->last_name = $name[1];
                }

                $newUser->email = $user->email;
                $newUser->role = 3;
                $newUser->password = Hash::make(encrypt(rand(10000000, 99999999)));
                $newUser->is_verified = true;
                $newUser->save();
                $newUser->patient()->save($patient);

                Auth::login($newUser);
                return redirect('/home');
            }
        } catch (Exception $e) {
            return redirect('/home');
        }
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();
            $finduser = User::where('email', $user->email)->first();
            if ($finduser) {
                Auth::login($finduser);
                return redirect('/home');
            } else {
                $patient = new Patient();
                $patient->mrn = getRandomMRN();

                $name = preg_split('#\s+#', $user->name, 2);
                $newUser = new User();

                $newUser->first_name = $name[0];
                $newUser->last_name = $name[1];
                $newUser->email = $user->email;
                $newUser->role = 3;
                $newUser->password = Hash::make(encrypt(rand(10000000, 99999999)));
                $newUser->is_verified = true;
                $newUser->save();
                $newUser->patient()->save($patient);

                Auth::login($newUser);
                return redirect('/home');
            }

        } catch (Exception $e) {
            return redirect('/home');
        }
    }
}
