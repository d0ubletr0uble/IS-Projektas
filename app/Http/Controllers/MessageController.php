<?php

namespace App\Http\Controllers;

use App\Models\Emoji;
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
//        $request->validate([
//            'audio' => 'required'
//        ]);

        $request->file('audio')->storeAs('audio/', time() . '.wav', 'public');

        //todo record into database

        return back();
    }

}
