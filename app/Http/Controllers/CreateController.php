<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;

class CreateController extends Controller
{
    public function index()
    {
        $groups = Group::all();

        return view('create', [
            'groups' => $groups
        ]);
    }

    public function create(Request $request)
    {
        $userId = Auth::id();
        $groups = new Group();
        $groups->name = $request->name1;
        $groups->users_id = $userId;     //session id gavimas
        $groups->save();

        return redirect('/messages/create');
    }
}
