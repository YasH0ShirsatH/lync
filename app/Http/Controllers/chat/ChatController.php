<?php

namespace App\Http\Controllers\chat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChatMessage;
use App\Models\User;

class ChatController extends Controller
{


    public function supportChat()
    {
        $users = User::whereNot('id', auth()->id())->get();
        $selectedUser = $users->first();
        return view('support.chat', compact('users', 'selectedUser'));
    }

public function getUser($id)
{
    $user = User::find($id); // or Teacher/Student model
    $messages = 'abc'; // Generate messages HTML here

    return response()->json([
        'user' => [
            'name' => $user->name,
            'email' => $user->email,
            'status' => 'Online'
        ],
        'messages' => $messages
    ]);
}

}
