<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\Events\MessageSent;
use App\Form;

class ChatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Render base template
    public function index($id)
    {
        if (!auth()->user()->is_admin) {
            $chosenForm = Form::with(['post'])
                ->where('id', $id)
                ->where('user_id', auth()->user()->id)
                ->first();
        } else $chosenForm = Form::with(['post'])
                ->whereHas('post', function($query) {
                    $query->where('user_id', '=', auth()->id());
                })
                ->where('id', $id)
                ->first();

        return view('chats', compact('chosenForm'));
    }

    // Forms
    public function fetchForms() {
        if (!auth()->user()->is_admin) {
            $forms = Form::with(['post'])
                ->where('user_id', auth()->id())
                ->latest()
                ->get();
        } else {
            $forms = Form::with(['post'])
                ->whereHas('post', function($query) {
                    $query->where('user_id', '=', auth()->id());
                })
                ->latest()
                ->get();
        }

        // get collection of messages containing the form id and count of
        // unread messages based authorized user request.
        $unreadIds = Message::select(\DB::raw('`to` as form_id, count(`to`) as messages_count'))
            ->where('from', '!=', auth()->user()->id)
            ->where('read', false)
            ->groupBy('to')
            ->get();

        // add an unread key to each form with the count of unread messages
        $forms = $forms->map(function($form) use ($unreadIds) {
            $unreadForm = $unreadIds->where('form_id', $form->id)->first();
            $form->unread_count = $unreadForm ? $unreadForm->messages_count : 0;
            return $form;
        });

        return response()->json($forms);
    }
    // Messages
    public function fetchMessages($id)
    {
        // mark all messages with the selected contact as read
        Message::where('to', $id)
            ->where('from', '!=', auth()->id())
            ->update(['read' => true]);

        $messages = Message::with(['fromUser','toForm'])
            ->where('to', $id)->get();


        return response()->json($messages);
    }

    // Message Send
    public function sendMessage(Request $request)
    {
        $newMessage = Message::create([
            'from' => auth()->id(),
            'to' => $request->to,
            'message' => $request->message
        ]);
        $newMessage->load(['fromUser','toForm']);

        broadcast(new MessageSent(
            $newMessage
        ))->toOthers();

        return response()->json($newMessage);
    }
}
