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
//        return $request->input('name');
        $img = $request->input('emoji');
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $img = base64_decode($img);
        $filepath = 'emoji'.time().'.jpg';
        Storage::put($filepath, $img);
        Emoji::create([
            'name' => '[:'.$request->input('name').':]',
            'link' => $filepath,
            'user_id' => Auth::id()
        ]);


    }
}
