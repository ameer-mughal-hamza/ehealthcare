<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function showChangePasswordForm()
    {
        $display = [
            'title' => 'EHealth Care | Change Password'
        ];

        return view('patient/change-password')->with($display);
    }

    public function submitChangePasswordForm(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|min:8,max:22|confirmed',
            'old_password' => 'required|min:8,max:22'
        ]);

        if (!(Hash::check($request->get('password'), Auth::user()->password))) {
            return redirect()->back()->with("error", "Your current password does not matches with the password.");
        }

        if (strcmp($request->get('password'), $request->get('new_password')) == 0) {
            return redirect()->back()->with("error", "New Password cannot be same as your current password.");
        }

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new_password'));
        $user->save();

        return redirect()->back()->with("success","Password successfully changed!");
    }

    public function showAccountSettingsForm()
    {

    }

    public function submitAccountSettingsForm()
    {

    }
}
