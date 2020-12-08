<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\EmojiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PagesController;

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

Route::get('/', function () {return view('welcome');});
// admin
Route::prefix('admin')->group(function () {
    Route::get('block/{id}', 'App\Http\Controllers\AdminController@block')->name('admin_block')->middleware('is_admin');
    Route::get('unblock/{id}', 'App\Http\Controllers\AdminController@unblock')->name('admin_unblock')->middleware('is_admin');

    Route::get('/statistics/{id}', function ($id) {return view('admin_statistics');})->name('admin_statistics')->middleware('is_admin');
    Route::get('/logincnt/{id}', function ($id) {return view('admin_logincnt');})->name('admin_logincnt')->middleware('is_admin');
    Route::get('/sentmesg/{id}', function ($id) {return view('admin_sentmesg');})->name('admin_sentmesg')->middleware('is_admin');

    Route::get('/admin_forum', function () {return view('admin_forum');})->name('admin_forum')->middleware('is_admin');
    Route::get('/admin_remove', function () {return view('admin_remove');})->name('admin_remove')->middleware('is_admin');
    Route::get('/admin_edit', function () {return view('admin_edit');})->name('admin_edit')->middleware('is_admin');

    Route::get('', [HomeController::class, 'AdminMove'])->name('admin')->middleware('is_admin');
    Route::get('', 'App\Http\Controllers\PagesController@UserList')->name('admin')->middleware('is_admin');
});
// admin

// message subsystem
Route::get('/messages', [MessageController::class, 'index']);
Route::get('/messages/emoji/create', [EmojiController::class, 'create']);
Route::post('/messages/emoji', [EmojiController::class, 'store']);
Route::delete('messages/emoji/{emoji}', [EmojiController::class, 'destroy']);
Route::post('/messages/photo', [MessageController::class, 'storePhoto']);
Route::get('/messages/audio/create', [MessageController::class, 'audio']);
Route::post('/messages/audio', [MessageController::class, 'storeAudio']);

// Grupės sukūrimas
Route::get('/messages/create', 'App\Http\Controllers\CreateController@index');
Route::post('/create', 'App\Http\Controllers\CreateController@create');



Route::get('/messages/edit', function () {
    return view('edit');
});
Route::get('/messages/edit/adduser', function () {
    return view('edit_adduser');
});
Route::get('/messages/edit/removeuser', function () {
    return view('edit_removeuser');
});
Route::get('/messages/edit/changename', function () {
    return view('edit_changename');
});



Route::prefix('forum')->name('Forumas')->group(function(){


    Route::get('/posts', 'App\Http\Controllers\PostController@index')->name('.posts');
    Route::get('/post/create', 'App\Http\Controllers\PostController@create')->name('.postcreate');
    Route::post('/post/store', 'App\Http\Controllers\PostController@store')->name('.poststore');
    Route::get('/post/show/{id}', 'App\Http\Controllers\PostController@show')->name('.postshow');
    Route::post('/comment/store', 'App\Http\Controllers\CommentController@store')->name('.commentadd');
    Route::get('/post/edit/{id}', 'App\Http\Controllers\PostController@edit')->name('.postedit');
    Route::match(['put','patch'],'edit/{id}', 'App\Http\Controllers\PostController@update')->name('.postupdate');
    Route::get('/comment/edit/{id}', 'App\Http\Controllers\CommentController@edit')->name('.commentedit');
    Route::match(['put','patch'],'/{id}', 'App\Http\Controllers\CommentController@update')->name('.commentupdate');
    Route::delete('/post/delete/{id}', 'App\Http\Controllers\PostController@destroy')->name('.postdestroy');
    Route::delete('/comment/delete/{id}', 'App\Http\Controllers\CommentController@destroy')->name('.commentdestroy');

});



// don't touch this function
Route::get('/git-pull', function () {
    exec('sudo git pull origin code');
    return redirect('/');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
