<?php

namespace App\Http\Controllers;

use App\Models\GroupMember;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;

class GroupsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $groups = Group::all();

        return view('groups.create', compact('groups'));
    }

    public function create()
    {
        $groups = Group::all();

        return view('groups.create', compact('groups'));
    }
    public function store(Request $request)
    {
        $name10 = User::where(['id' => Auth::id()])->get()->first();
        $name = $name10->username;
        //dd($name);
        $group = Group::create(
            [
                'name' => $request->input('name1'),
                'users_id' => Auth::id()
            ]
        );

        GroupMember::create(
            [
                'group_id' => $group->id,
                'user_id' => Auth::id(),
                'nick' => $name
            ]
        );

        return redirect('/messages');
    }

    public function edit(Group $group)
    {
        dd($group);
    }


}
