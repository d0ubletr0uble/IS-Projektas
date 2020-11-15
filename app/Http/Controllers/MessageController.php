<?php

namespace App\Http\Controllers;

use App\Models\Emoji;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $emojis = Emoji::where('user_id', Auth::id())->get();
        return view('messages', compact('emojis'));
    }

    public function audioMessage()
    {
        return view('audio');
    }
}
