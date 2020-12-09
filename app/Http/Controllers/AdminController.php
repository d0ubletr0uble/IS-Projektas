<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Info;
use App\Models\Message;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }
    
    public function block($id)
    {
        $random = User::find($id)->where('id',$id)->get("is_admin");
        foreach ($random as $r) {
            if($r->is_admin != 1) {
                $users = User::find($id);
                $users = $users->where('id',$id);
                $users = $users->update(array('is_blocked'=>1));
                $users = User::all();
            }
        }
        return redirect()->route('admin');
    }
    
    public function unblock($id)
    {
        $users = User::find($id);
        $users = $users->where('id',$id);
        $users = $users->update(array('is_blocked'=>0));
        $users = User::all();
        return redirect()->route('admin');
    }

    public function login_count($id)
    {
        $info = Info::where('user_id',$id)->get();
        return view('admin_logincnt')->with('info', $info); 
    }
    public function sent_messages($id)
    {
        $messages = Message::where('id',$id)->get();//userid or id
        return view('admin_sentmesg')->with('messages', $messages); 
    }
}