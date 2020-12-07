<?php

namespace App\Http\Controllers;

use App\Models\Emoji;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EmojiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('messages.emoji.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'emoji' => 'required'
            ]
        );

        $img = $request->input('emoji');
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $img = base64_decode($img);
        $fileName = 'emoji' . time() . '.jpg';
        $emoji = Emoji::create([
            'name' => '[:' . $request->input('name') . ':]',
            'link' => $fileName,
            'user_id' => Auth::id()
        ]);
        if ($emoji->exists())
            Storage::put('public/emoji/' . $fileName, $img); // store image of emoji on disk
    }

    public function destroy(Emoji $emoji)
    {
        if ($emoji->user_id == Auth::id()) // if user owns emoji
        {
            Storage::delete('public/' . $emoji->link); //delete actual image
            $emoji->delete(); // delete database row
        }
    }
}
