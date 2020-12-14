<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Info;
use App\Models\Message;
use Illuminate\Support\Facades\DB;

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
        $messages = Message::join('group_members','group_members.group_id','messages.group_id')->where('group_members.user_id',$id)->get();
        return view('admin_sentmesg')->with('messages', $messages); 
    }

    public function user_statistics($id)
    {   
        $query_mesg_type = 'SELECT `freedbtech_orange`.`messages`.`type`,COUNT(`freedbtech_orange`.`messages`.`type`) as `num`
                            FROM `freedbtech_orange`.`group_members`
                            INNER JOIN `freedbtech_orange`.`messages`
                            ON `freedbtech_orange`.`group_members`.`group_id` = `freedbtech_orange`.`messages`.`group_id`
                            WHERE `freedbtech_orange`.`group_members`.`user_id` = :id
                            GROUP BY `freedbtech_orange`.`messages`.`type`';
        $mesg_count = DB::select($query_mesg_type, ['id' => $id]);

        $query_ips = 'SELECT `freedbtech_orange`.`login_info`.`ip`,COUNT(`freedbtech_orange`.`login_info`.`ip`) as `num`
                      FROM `freedbtech_orange`.`login_info`
                      WHERE `freedbtech_orange`.`login_info`.`user_id` = :id
                      GROUP BY `freedbtech_orange`.`login_info`.`ip`';
        $ip_count = DB::select($query_ips, ['id' => $id]);

        $query_devices = 'SELECT `freedbtech_orange`.`login_info`.`device`,COUNT(`freedbtech_orange`.`login_info`.`device`) as `num`
                          FROM `freedbtech_orange`.`login_info`
                          WHERE `freedbtech_orange`.`login_info`.`user_id` = :id
                          GROUP BY `freedbtech_orange`.`login_info`.`device`';
        $device_count = DB::select($query_devices, ['id' => $id]);

        $query_search= 'SELECT `freedbtech_orange`.`search_info`.`search_info`,`freedbtech_orange`.`search_info`.`date` 
                        FROM `freedbtech_orange`.`search_info`
                        WHERE `freedbtech_orange`.`search_info`.`user_id` = :id';
        $searches = DB::select($query_search, ['id' => $id]);

        return view('admin_statistics')->with('mesg_count', $mesg_count)->with('ip_count',$ip_count)->with('device_count',$device_count)->with('searches',$searches);   
    }
}