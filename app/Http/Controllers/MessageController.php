<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::all();
        $display = [
            'title' => 'Message',
            'messages' => $messages

        ];
        return view('admin/messages/index')->with($display);
    }

    public function show($id)
    {
        $message = Message::find($id);

        $display = [
            'title' => 'Message',
            'message' => $message

        ];
        return view('admin/messages/show')->with($display);
    }

    public function delete($id)
    {
        $message = Message::find($id);

        if ($message) {
            $message->delete();
            session()->flash('deleted_message', 'Record deleted successfully.');
            return redirect()->route('view_all_messages');
        }

        session()->flash('not_found', 'No such record found.');

        return redirect()->back();
    }
}
