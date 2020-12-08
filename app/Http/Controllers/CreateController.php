<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;

class CreateController extends Controller
{
    public function index()
    {
        $group = Group::all();

        return view('create', [
            'group' => $group
        ]);
    }

    public function create(Request $request)
    {
        $group = new Group();
        $group->name = $request->name1;

        $group->save();

        return redirect('/messages/create');
    }
}
