<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;

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

Route::get('/messages', [MessageController::class, 'index'])->name('messages');
Route::get('/audio-message', [MessageController::class, 'audioMessage'])->name('audio');
Route::get('/new-emoji', [\App\Http\Controllers\EmojiController::class, 'createEmoji'])->name('create-emoji');

// don't touch this function
Route::get('/git-pull', function () {
    exec('sudo git pull origin code');
    return redirect('/');
});
