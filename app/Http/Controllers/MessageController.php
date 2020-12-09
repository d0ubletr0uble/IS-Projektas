<?php

namespace App\Http\Controllers;

use App\Models\Emoji;
use App\Models\Group;
use App\Models\GroupMember;
use App\Models\Message;
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
        $emojis = Emoji::getUserEmojis(Auth::id());
        $groups = Group::getUserGroups(Auth::id());
        return view('messages.index', compact('emojis', 'groups'));
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

    public function storeMessage(Group $group, Request $request)
    {
        if (!$group->hasUser(Auth::id()))
            return response('Unauthorized.', 401);
        else {
            Message::create([
                'content' => $request->input('text'),
                'type' => 'text',
                'status' => 'sent',
                'group_id' => $group->id,
                'group_member_id' => GroupMember::getMemberId($group->id, Auth::id())
            ]);
        }
    }

    public function getGroupMessages(Group $group)
    {
        if (!$group->hasUser(Auth::id()))
            return response('Unauthorized.', 401);
        else {
            //user belongs to group
            return $group->getMessages()->toJson();
        }
    }

}
