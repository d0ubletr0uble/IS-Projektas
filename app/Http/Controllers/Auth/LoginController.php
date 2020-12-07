<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Info;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Overriden default one to make login with username instead of email
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        if (auth()->attempt(
            [
                'username' => $request->input('username'),
                'password' => $request->input('password'),
            ]
        )
        ) {
            // $username = $request->input('username');
            // $users = User::select('id')->where('username',$username)->first();
            // $info = new Info;
            // $info->id = $users->id;
            // $info->country = 'LT';
            // $info->device = 'Phone';
            // $info->browser = 'Mozilla';
            // $info->date = date('Y-m-d H:i:s');
            // $info->ip = '192.20.10.1';
            // $info->os = 'Win';
            // $info->provider = 'Telia';
            // error_log($info->id);
            // error_log($info->country);
            // error_log($info->device);
            // error_log($info->browser);
            // error_log($info->date);
            // error_log($info->ip);
            // error_log($info->os);
            // error_log($info->provider);
            // $info->save();
            return redirect()->intended('home');
        } else {
            return redirect()->route('login')->with('error', 'Username and Password combination is wrong.');
        }

    }
}