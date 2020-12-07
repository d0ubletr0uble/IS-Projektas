<?php

namespace App\Http\Controllers;

use App\Models\Emoji;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $emojis = Emoji::where('user_id', Auth::id())->get();
        return view('messages.index', compact('emojis'));
    }

    public function audio()
    {
        return view('messages.audio.create');
    }

    public function storePhoto(Request $request)
    {
        $request->validate([
            'filename' => 'required|mimes:jpeg,bmp,png|max:2048'
        ]);

        $fileName = time() . '_' . $request->file('filename')->getClientOriginalName();
        $request->file('filename')->storeAs('photos/', $fileName, 'public');

        //todo record into database

        return back();
    }

    public function storeAudio(Request $request)
    {
        $filename = time() . '.wav';
        $request->file('audio')->storeAs('audio/', $filename, 'public');

        Message::create([
            'content' => '/storage/audio/' . $filename,
            'type' => 'audio',
            'status' => 'sent',
            'group_id' => 1,
            'group_member_id' => Auth::id()
        ]);

        return back();
    }

    public function storeMessage(Request $request)
    {

    }

}
