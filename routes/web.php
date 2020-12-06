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
    Route::get('/block', function () {return view('admin_block');})->middleware('is_admin');
    Route::get('/unblock', function () {return view('admin_unblock');})->middleware('is_admin');
    Route::get('/statistics', function () {return view('admin_statistics');})->middleware('is_admin');
    Route::get('/logincnt', function () {return view('admin_logincnt');})->middleware('is_admin');
    Route::get('/sentmesg', function () {return view('admin_sentmesg');})->middleware('is_admin');
    Route::get('/admin_forum', function () {return view('admin_forum');})->middleware('is_admin');
    Route::get('/admin_remove', function () {return view('admin_remove');})->middleware('is_admin');
    Route::get('/admin_edit', function () {return view('admin_edit');})->middleware('is_admin');
    Route::get('', [HomeController::class, 'AdminMove'])->name('admin')->middleware('is_admin');
    Route::get('', 'App\Http\Controllers\PagesController@UserList')->name('admin')->middleware('is_admin');
});
// admin

// message subsystem
Route::get('/messages', [MessageController::class, 'index']);
Route::get('/audio-message', [MessageController::class, 'audioMessage']);
Route::get('/messages/emoji/create', [EmojiController::class, 'create']);
Route::post('/messages/emoji', [EmojiController::class, 'store']);
Route::delete('messages/emoji/{emoji}', [EmojiController::class, 'destroy']);
Route::post('/messages/photo', [MessageController::class, 'storePhoto']);


Route::get('/messages/edit', function () {
    return view('edit');
});
Route::get('/messages/create', function () {
    return view('create');
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

    Route::get('', 'App\Http\Controllers\TopicsController@index')->name('.index');

    Route::get('/addtopic', function () { return view('Forumas.forum_addtopic');});

    Route::POST('/addtopic/confirmed','App\Http\Controllers\TopicsController@submit');


    Route::delete('/{id}', 'App\Http\Controllers\TopicsController@destroy');

    Route::get('/{id}/edit', 'App\Http\Controllers\TopicsController@edit')->name('.edit');

    Route::match(['put','patch'],'/{id}', 'App\Http\Controllers\TopicsController@update')->name('.update');

    Route::get('/test', function () {return view('Forumas.forum_test');});

    Route::get('/search', function () {return view('Forumas.forum_search');});

});



// don't touch this function
Route::get('/git-pull', function () {
    exec('sudo git pull origin code');
    return redirect('/');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');