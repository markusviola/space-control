<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;

class ChatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('chats');
    }

    public function fetchMessages()
    {
        return Message::with('user')->get();
    }

    public function sendMessage(Request $request)
    {
        $newMessage = $request->message;
        auth()->user()->messages()->create([
            'message' => $newMessage
        ]);
        return response()->json([
            'success' => true,
            'message' => $newMessage
        ]);
    }
}
