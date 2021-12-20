<?php

namespace App\Http\Controllers;

use App\Models\Message;
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

    public function contactUsSubmit(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3,max:26',
            'email' => 'required|email',
            'message' => 'required|min:30,max:1000'
        ]);

        $contact = new Message();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->message = $request->message;

        $contact->save();

        return redirect()->back('message', 'Thanks for contacting us! We will get back to you shortly.');
    }
}
