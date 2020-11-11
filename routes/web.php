<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\EmojiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    return view('admin');
});

Route::get('/admin/block', function () {
    return view('admin_block');
});

Route::get('/admin/unblock', function () {
    return view('admin_unblock');
});

Route::get('/admin/statistics', function () {
    return view('admin_statistics');
});

Route::get('/admin/logincnt', function () {
    return view('admin_logincnt');
});

Route::get('/admin/sentmesg', function () {
    return view('admin_sentmesg');
});

// message subsystem
Route::get('/messages', [MessageController::class, 'index'])->name('messages');
Route::get('/audio-message', [MessageController::class, 'audioMessage'])->name('audio');
Route::get('/new-emoji', [EmojiController::class, 'createEmoji'])->name('create-emoji');


Route::get('/forum', function () {
    return view('forum');
});

Route::get('/forum/addtopic', function () {
    return view('forum_addtopic');
});

Route::get('/forum/test', function () {
    return view('forum_test');
});


// don't touch this function
Route::get('/git-pull', function () {
    exec('sudo git pull origin code');
    return redirect('/');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
