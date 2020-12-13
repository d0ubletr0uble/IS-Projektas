<?php

namespace App\Http\Controllers;

use App\Models\Emoji;
use App\Models\Group;
use App\Models\GroupMember;
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
        $emojis = Emoji::getUserEmojis(Auth::id());
        $groups = Group::getUserGroups(Auth::id());
        return view('messages.index', compact('emojis', 'groups'));
    }

    public function audio(Group $group)
    {
        return view('messages.audio.create', compact('group'));
    }

    public function storePhoto(Request $request)
    {
        $request->validate([
            'filename' => 'required|mimes:jpeg,bmp,png|max:2048'
        ]);

        $id = $request->input('group_id');
        $fileName = time() . '_' . $request->file('filename')->getClientOriginalName();
        $request->file('filename')->storeAs('photos/', $fileName, 'public');

        Message::create([
            'content' => '/storage/photos/' . $fileName,
            'type' => 'photo',
            'status' => 'sent',
            'group_id' => $id,
            'group_member_id' => GroupMember::getMemberId($id, Auth::id())
        ]);

//        return response(null);
        return back();
    }

    public function storeAudio(Request $request)
    {
        $id = $request->input('group_id');
        $filename = time() . '.wav';
        $request->file('audio')->storeAs('audio/', $filename, 'public');
        Message::create([
            'content' => '/storage/audio/' . $filename,
            'type' => 'audio',
            'status' => 'sent',
            'group_id' => $id,
            'group_member_id' => GroupMember::getMemberId($id, Auth::id())
        ]);

        return response(null);
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
            return response(null);
        }
    }

    public function destroy(Message $message)
    {
        $group = Group::where('id', $message->group_id)->get()->first();
        if ($message->group_member_id == $group->getMemberId(Auth::id())) {
            $message->status = 'deleted';
            $message->save();
            return response(null);
        }

    }

    public function getGroupMessages(Group $group)
    {
        return $group->getMessages();
    }

    public function getLastMessageId(Group $group)
    {
        return $group->getLastMessageId();
    }

}
