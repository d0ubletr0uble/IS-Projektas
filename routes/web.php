<?php

use App\Http\Controllers\GroupsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\EmojiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PagesController;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

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
    Route::get('/logincnt/{id}', 'App\Http\Controllers\AdminController@login_count')->name('admin_logincnt')->middleware('is_admin');
    Route::get('/sentmesg/{id}', 'App\Http\Controllers\AdminController@sent_messages')->name('admin_sentmesg')->middleware('is_admin');
    Route::get('/statistics/{id}', 'App\Http\Controllers\AdminController@user_statistics')->name('admin_statistics')->middleware('is_admin');

    Route::get('/admin_forum', function () {return view('admin_forum');})->name('admin_forum')->middleware('is_admin');
    Route::get('/admin_remove', function () {return view('admin_remove');})->name('admin_remove')->middleware('is_admin');
    Route::get('/admin_edit', function () {return view('admin_edit');})->name('admin_edit')->middleware('is_admin');

    Route::get('', [HomeController::class, 'AdminMove'])->name('admin')->middleware('is_admin');
    Route::get('', 'App\Http\Controllers\PagesController@UserList')->name('admin')->middleware('is_admin');
});
// admin

// message subsystem
Route::get('/messages', [MessageController::class, 'index'])->middleware('is_blocked');
Route::get('/messages/{group}', [MessageController::class, 'getGroupMessages'])->middleware('is_blocked');
Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->middleware('is_blocked');
Route::get('/messages/pulse/{group}', [MessageController::class, 'getLastMessageId'])->middleware('is_blocked');
Route::post('/messages/groups/{group}', [MessageController::class, 'storeMessage'])->middleware('is_blocked');
Route::get('/messages/emoji/create', [EmojiController::class, 'create'])->middleware('is_blocked');
Route::post('/messages/emoji', [EmojiController::class, 'store'])->middleware('is_blocked');
Route::delete('messages/emoji/{emoji}', [EmojiController::class, 'destroy']);
Route::post('/messages/photo', [MessageController::class, 'storePhoto']);
Route::get('/messages/audio/create/{group}', [MessageController::class, 'audio'])->middleware('is_blocked');
Route::post('/messages/audio', [MessageController::class, 'storeAudio']);
Route::get('/messages/emoji/list', [EmojiController::class, 'getUserEmojis'])->middleware('is_blocked');

// Grupės sukūrimas
Route::get('/messages/groups/create', [GroupsController::class, 'create']);
Route::get('messages/groups/{group}', [GroupsController::class, 'edit']);
Route::post('/messages/groups', [GroupsController::class, 'store']);



Route::get('/messages/edit', function () {
    return view('edit');
})->middleware('is_blocked');
Route::get('/messages/edit/adduser', function () {
    return view('edit_adduser');
})->middleware('is_blocked');
Route::get('/messages/edit/removeuser', function () {
    return view('edit_removeuser');
})->middleware('is_blocked');
Route::get('/messages/edit/changename', function () {
    return view('edit_changename');
})->middleware('is_blocked');



Route::prefix('forum')->name('Forumas')->group(function(){


    Route::get('/posts', 'App\Http\Controllers\PostController@index')->name('.posts')->middleware('is_blocked');

    Route::get('/post/create', 'App\Http\Controllers\PostController@create')->name('.postcreate')->middleware('is_blocked');
    Route::post('/post/store', 'App\Http\Controllers\PostController@store')->name('.poststore');
    Route::get('/post/show/{id}', 'App\Http\Controllers\PostController@show')->name('.postshow')->middleware('is_blocked');
    Route::post('/comment/store', 'App\Http\Controllers\CommentController@store')->name('.commentadd');

    Route::get('/post/edit/{id}', 'App\Http\Controllers\PostController@edit')->name('.postedit');
    Route::match(['put','patch'],'edit/{id}', 'App\Http\Controllers\PostController@update')->name('.postupdate');
    Route::get('/comment/edit/{id}', 'App\Http\Controllers\CommentController@edit')->name('.commentedit')->middleware('is_blocked');
    Route::match(['put','patch'],'/{id}', 'App\Http\Controllers\CommentController@update')->name('.commentupdate');
    Route::delete('/post/delete/{id}', 'App\Http\Controllers\PostController@destroy')->name('.postdestroy');
    Route::delete('/comment/delete/{id}', 'App\Http\Controllers\CommentController@destroy')->name('.commentdestroy');

    Route::any ( '/search', function () {
        $q = Request::input ( 'q' );
        $message = Post::where ( 'title', 'LIKE', '%' . $q . '%' )->orWhere ( 'username', 'LIKE', '%' . $q . '%' )->get ();
        if (count ( $message ) > 0){
            if(strlen ( $q ) > 0){
                $query = 'INSERT INTO `freedbtech_orange`.`search_info` (`freedbtech_orange`.`search_info`.`search_info`,`freedbtech_orange`.`search_info`.`user_id`,`freedbtech_orange`.`search_info`.`date`) VALUES (:q,:id,:dt)';
                $insert = DB::insert($query, ['q' => $q,'id' => Auth::user()->id,'dt' => date('Y-m-d H:i:s')]);
            }
            return view ( 'Forumas.search' )->withDetails ( $message )->withQuery ( $q );
        }
        else{
            if(strlen ( $q ) > 0){
                $query = 'INSERT INTO `freedbtech_orange`.`search_info` (`freedbtech_orange`.`search_info`.`search_info`,`freedbtech_orange`.`search_info`.`user_id`,`freedbtech_orange`.`search_info`.`date`) VALUES (:q,:id,:dt)';
                $insert = DB::insert($query, ['q' => $q,'id' => Auth::user()->id,'dt' => date('Y-m-d H:i:s')]);
            }
            return view ( 'Forumas.search' )->withMessage ( 'Temų su tokiu pavadinimu nebuvo rasta' );
        }
    } ) ->name('.search');
});



// don't touch this function
Route::get('/git-pull', function () {
    exec('sudo git pull origin code');
    return redirect('/');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');