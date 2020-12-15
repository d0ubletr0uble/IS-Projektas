<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\GroupMember;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class EditController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function editshow($group_id)
    {
        $id = Group::where(['id' => $group_id])->first();
        return view('edit')->with('groupid', $id);
    }
    public function addshow($group_id)
    {
        $id = Group::where(['id' => $group_id])->first();
        return view('edit_adduser')->with('groupid', $id);;
    }
    public function removshow($group_id, Request $request)
    {
        $id = Group::where(['id' => $group_id])->first();
        //$id = Group::find($id);
        $groupsMembs = GroupMember::All();
        $user = User::All();
        return view('edit_removeuser', compact('groupsMembs','id','user'));
    }
    public function changeshow($group_id, Request $request)
    {
        $name = Group::where(['id' => $group_id])->first();
        return view('edit_changename')->with('groupid', $name);
    }
    public function change($group_id, Request $request)
    {
        $id = Group::where(['id' => $group_id])->get()->first();
        //dd($id);
        $name10 = Group::find($id->id);
        $yo = $request->name1;
        $name10->name = $request->input('name1');
        //dd($name10);
        $name10->save();
        return back();
    }
    public function destroy($id)
    {
        $groupMemb = GroupMember::find($id);
        $groupMembMessg = Message::find($id);
        $groupMembMessg->delete();
        $groupMemb->delete();
        return back();
    }
    public function search($group_id, Request $request){
        $id = Group::where(['id' => $group_id])->first();
        $memb = GroupMember::All();
        $search_text = $request->input('usname');;
        $futurememb = User::where('username', 'LIKE', '%'.$search_text.'%')->get();

        return view('edit_adduser_search', compact('futurememb', 'id', 'memb'));
    }
    public function addMemb($group_id, Request $request)
    {
        $id = Group::where(['id' => $group_id])->get()->first();
        $id = $id->id;
        $groupMember = new GroupMember();
        $groupMember->group_id = $id;
        $groupMember->user_id = $request->futumemb_id;
        $groupMember->save();
        return back();
    }
}
