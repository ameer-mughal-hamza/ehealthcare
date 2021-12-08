<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\WelcomeEmailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index()
    {
//        $user = User::find(2);
//        $display = [
//            'url' => Crypt::encryptString($user->id)
//        ];
//
//        $user->notify(new WelcomeEmailNotification($display));

        $display = array(
            'title' => getTitle('Home')
        );
        return view('landing-page/home')->with($display);
    }
}
