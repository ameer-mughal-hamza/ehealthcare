<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;

class SocialController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->user();

            dd($user);

            $finduser = User::where('google_id', $user->id)->first();

            if($finduser){

                Auth::login($finduser);

                return redirect('/home');

            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'password' => encrypt('123456dummy')
                ]);

                Auth::login($newUser);

                return redirect('/home');
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleFacebookCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();
            $finduser = User::where('email', $user->email)->first();
            if($finduser){
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
                $newUser->save();
                $newUser->patient()->save($patient);

                Auth::login($newUser);
                return redirect('/home');
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
