<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmojiController extends Controller
{
    public function createEmoji()
    {
        return view('emoji');
    }
}
