<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\GroupMember;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make(
            [
                'name' => $request->input('name1')
            ],
            [
                'name' =>'required|unique:App\Models\Group,name'
            ]
    );
        if($validator->fails()) return Redirect::back()->with('bad','Pavadinimas jau užimtas');
        else {
            $id = Group::where(['id' => $group_id])->get()->first();
            $name10 = Group::find($id->id);
            $name10->name = $request->input('name1');
            $name10->save();
            return redirect('/messages');
        }
    }
    public function destroy($id, Request $request)
    {
        $groupMemb = $request->idMemb;
        $groupMemb = GroupMember::where(['id' => $groupMemb])->first();
        $groupMemb->matymas = 1;
        $groupMemb->save();
        return back();
    }
    public function search($group_id, Request $request){
        $id = Group::where(['id' => $group_id])->first();
        $search_text = $request->input('usname');;
        $memb = GroupMember::where('nick', 'LIKE', '%'.$search_text.'%')->get();
        $futurememb = User::where('username', 'LIKE', '%'.$search_text.'%')->get();

        return view('edit_adduser_search', compact('futurememb', 'id', 'memb'));
    }
    public function addMemb($group_id, Request $request)
    {
        $groupmembinf = GroupMember::where(['group_id' => $group_id, 'user_id' => $request->futumemb_id, 'matymas' => 0])->get();
        if($groupmembinf->count() > 0)
        {
            return back()->with('status','Narys yra grupėje');
        }
        else
            {
                $id = Group::where(['id' => $group_id])->get()->first();
                $id = $id->id;
                $groupMember = GroupMember::where(['user_id' => $request->futumemb_id, 'group_id' => $group_id])->first();
                $groupMember->group_id = $id;
                $groupMember->user_id = $request->futumemb_id;
                $groupMember->nick = $request->futumemb_name;
                $groupMember->matymas = 0;
                $groupMember->save();
                return back()->with('good','Narys pridėtas');

        }
    }
    public function leave($groupid, Request $request)
    {
        $groupMemb1 = $request->idMemb;
        $groupMemb = GroupMember::where(['user_id' => $groupMemb1, 'group_id' => $groupid, 'matymas' => 0])->first();
        $groupMemb->matymas = 1;
        $groupMemb->save();
        return redirect('/messages');
    }
}