<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $display = array(
            'title' => getTitle('Contact Us')
        );
        return view('landing-page/contact')->with($display);
    }
}
