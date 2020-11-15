<?php

namespace App\Http\Controllers;

use App\Models\Emoji;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EmojiController extends Controller
{
    public function create()
    {
        return view('emoji.create');
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
        Storage::put('public/' . $fileName, $img); // store image of emoji on disk
        Emoji::create([
            'name' => '[:' . $request->input('name') . ':]',
            'link' => $fileName,
            'user_id' => Auth::id()
        ]);
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
