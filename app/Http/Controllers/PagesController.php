<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class PagesController extends Controller
{
  public function UserList(){
      $users = User::all();
      return view('admin')->with('users', $users);
  }
}